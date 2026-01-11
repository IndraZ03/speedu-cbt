<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Transaction\PaymentConfirmationRequest;
use Illuminate\Http\Request;
use App\Repositories\User\AccountBalanceRepository;
use App\Http\Requests\User\AccountBalanceRequest;
use App\Models\AccountBalance;
use App\Models\Setting;
use App\Models\Transaction\PaymentConfirmation;
use App\Repositories\Transaction\BankRepository;
use App\Repositories\Exam\ExamRepository;
use App\Repositories\Exam\ExamGroupRepository;
use App\Repositories\Transaction\TransactionRepository;
use DB;
use Auth;
use App\Models\User;
use Midtrans\Snap;
use Midtrans\Transaction;

class AccountBalanceController extends Controller
{
    protected $accountBalanceRepository;

    public function __construct(AccountBalanceRepository $accountBalanceRepository)
    {
        $this->accountBalanceRepository = $accountBalanceRepository;

        \Midtrans\Config::$serverKey = config('services.midtrans.serverKey');
        \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');
        \Midtrans\Config::$isSanitized = config('services.midtrans.isSanitized');
        \Midtrans\Config::$is3ds = config('services.midtrans.is3ds');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return inertia('User/AccountBalance/Index', [
            'accountBalances' => $this->accountBalanceRepository->getAllPaginatedWithParamsByUser($request),
            'banks' => (new BankRepository())->all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AccountBalanceRequest $request)
    {
        try {
            $attributes = $request->validated();
            $attributes['code'] = AccountBalance::generateCode();
            $attributes['user_id'] = Auth::user()->id;
            $transaction = AccountBalance::create($attributes);

            if ($request->payment_method == 'automatic_transfer_midtrans') {
                $snapToken = DB::transaction(function () use ($transaction) {
                    $payload = [
                        'transaction_details' => [
                            'order_id' => $transaction->code,
                            'gross_amount' => (int)$transaction->top_up_balance
                        ],
                        'customer_details' => [
                            'first_name' => $transaction->user->name,
                            'email' => $transaction->user->email,
                            'phone' => $transaction->user && $transaction->user->student ? $transaction->user->student->phone_number : '',
                        ],
                        'item_details' => [
                            [
                                'id' => $transaction->id,
                                'price' => (int)$transaction->top_up_balance,
                                'quantity' => 1,
                                'name' => 'Top Up Saldo ' . $transaction->code,
                            ]
                        ]
                    ];

                    $snapToken = Snap::getSnapToken($payload);

                    $transaction->snap_token = $snapToken;

                    $transaction->save();

                    return $this->response['snapToken'] = $snapToken;
                });
            } else {
                session()->flash('success', 'Silakan untuk melakukan pembayaran.');
            }

            return redirect()->route('user.account-balances.show', $transaction->id);
        } catch (\Exception $e) {
            session()->flash('failed', $e->getMessage() . ' in file :' . $e->getFile() . ' line: ' . $e->getLine());

            return redirect()->back()->withInput($request->all());
        }
    }

    public function buyExam($examId, Request $request)
    {
        try {
            if ($request->type == 'exam') {
                $exam = (new ExamRepository())->find($examId);
            } else {
                $exam = (new ExamGroupRepository())->find($examId);
            }

            if (!$exam) {
                return abort('404');
            }

            if ($exam->price_after_discount > Auth::user()->account_balance) {
                session()->flash('error', 'Saldo Anda Tidak Cukup Untuk Membeli Latihan Soal, silakan Top Up saldo terlebih dahulu.');
                return redirect()->back();
            }

            (new TransactionRepository())->createTransaction($examId, $request->type);

            session()->flash('success', 'Pembelian ' . ($request->type == 'exam' ? 'Latihan Soal' : 'Try Out') . ' berhasil.');
            return redirect()->back();
        } catch (\Throwable $e) {
            return $e;
            session()->flash('error', $e->getMessage() . ' in file :' . $e->getFile() . ' line: ' . $e->getLine());
            return redirect()->back();
        }
    }

    public function show($id)
    {
        $transaction = $this->accountBalanceRepository->find($id);
        $paymentConfirmation = PaymentConfirmation::where('transaction_id_account_balance', $transaction->id)->With('bank')->first();
        if (!$transaction) return abort('404', 'uppss....');

        return inertia('User/AccountBalance/Show', [
            'transaction' => $transaction,
            'payment_confirmation' => $paymentConfirmation,
            'banks' => (new BankRepository())->all(),
            'setting' => (new Setting())->first(),
        ]);
    }


    public function pay(Request $request)
    {
        $transaction = $this->accountBalanceRepository->find($request->transaction_id);

        if (!$transaction || $transaction->user_id != Auth::id()) return abort('404', 'uppss....');

        $checkTransaction = (object) Transaction::status($transaction->code);

        if (isset($checkTransaction->transaction_status) && $checkTransaction->transaction_status == 'settlement' && $transaction->payment_method == 'automatic_transfer_midtrans') {
            DB::transaction(function () use ($transaction) {
                $transaction->transaction_status = 'done';
                $transaction->save();
                $user = User::find($transaction->user_id);
                $user->account_balance += $transaction->top_up_balance;
                $user->save();
            });
        }
        return redirect()->route('user.account-balances.index');
    }


    public function paymentConfirmation($transactionId)
    {
        $transaction = $this->accountBalanceRepository->find($transactionId);

        if (!$transaction) return abort('404', 'uppss....');

        if ($transaction->payment_method != 'manual_transfer' || $transaction->transaction_status == 'paid') {
            session()->flash('failed', 'Anda tidak bisa mengakses halaman tersebut, karena metode tidak sesuai atau anda telah melakukan konfirmasi pembayaran');
            return redirect()->route('user.account-balances.show', $transactionId);
        }

        return inertia('User/AccountBalance/PaymentConfirm', [
            'transaction' => $transaction,
            'banks' => (new BankRepository())->all()
        ]);
    }

    public function storePaymentConfirmation(PaymentConfirmationRequest $request, $transactionId)
    {
        try {
            $transaction = $this->accountBalanceRepository->find($transactionId);

            if (is_null($transaction)) {
                return abort(404, 'uppss....');
            }

            $result = $this->accountBalanceRepository->paymentConfirmation($transactionId, $request);

            if (is_null($result)) {
                session()->flash('error', 'Konfirmasi pembayaran gagal. Silakan coba lagi.');
                return redirect()->back();
            }

            session()->flash('success', 'Konfirmasi pembayaran berhasil. Silakan tunggu hingga admin melakukan persetujuan pada transaksi anda dengan kode ' . $transaction->code);

            return redirect()->route('user.account-balances.show', $transactionId);
        } catch (\Throwable $e) {
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back();
        }
    }
}
