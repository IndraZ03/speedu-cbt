<?php

namespace App\Http\Controllers\User\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Transaction\TransactionRepository;
use App\Repositories\Transaction\BankRepository;
use App\Http\Requests\Transaction\PaymentConfirmationRequest;
use App\Models\UserMemberCategory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Midtrans\Transaction;

class TransactionController extends Controller
{
    protected $transactionRepository;

    public function __construct(TransactionRepository $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;

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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return inertia('User/Transaction/Transaction/Index', [
            'transactions' => $this->transactionRepository->getAllPaginatedWithParamsByUser($request)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaction = $this->transactionRepository->find($id);

        if (!$transaction) return abort('404', 'uppss....');

        return inertia('User/Transaction/Transaction/Show', [
            'transaction' => $transaction,
            'banks' => (new BankRepository())->all()
        ]);
    }

    public function paymentConfirmation($transactionId)
    {
        $transaction = $this->transactionRepository->find($transactionId);

        if (!$transaction) return abort('404', 'uppss....');

        if ($transaction->payment_method != 'manual_transfer' || $transaction->transaction_status == 'paid') {
            session()->flash('failed', 'Anda tidak bisa mengakses halaman tersebut, karena metode tidak sesuai atau anda telah melakukan konfirmasi pembayaran');
            return redirect()->route('user.transactions.show', $transactionId);
        }

        return inertia('User/Transaction/Transaction/PaymentConfirm', [
            'transaction' => $transaction,
            'banks' => (new BankRepository())->all()
        ]);
    }

    public function storePaymentConfirmation(PaymentConfirmationRequest $request, $transactionId)
    {
        try {
            $transaction = $this->transactionRepository->find($transactionId);

            if (!$transaction) {
                abort(404, 'uppss....');
            }

            $this->transactionRepository->paymentConfirmation($transactionId, $request);

            session()->flash('success', 'Konfirmasi pembayaran berhasil. Silakan tunggu hingga admin melakukan persetujuan pada transaksi anda dengan kode ' . $transaction->code);

            return redirect()->route('user.transactions.show', $transactionId);
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->back();
        }
    }

    public function pay(Request $request)
    {
        $transaction = $this->transactionRepository->find($request->transaction_id);

        if (!$transaction || $transaction->user_id != Auth::id()) return abort('404', 'uppss....');

        $checkTransaction = (object) Transaction::status($transaction->code);

        if (isset($checkTransaction->transaction_status) && $checkTransaction->transaction_status == 'settlement' && $transaction->payment_method == 'automatic_transfer_midtrans') {
            DB::transaction(function () use ($transaction) {
                $transaction->transaction_status = 'done';
                $transaction->expired_date = Carbon::now()->addMonths($transaction->active_period);
                $transaction->save();
            });

            UserMemberCategory::create([
                'transaction_id' => $transaction->id,
                'user_id' => $transaction->user_id,
                'category_id' => $transaction->category_id,
                'description' => $transaction->description,
                'member_categories' => $transaction->member_categories,
                'expired_date' => $transaction->expired_date,
            ]);
        }
        return redirect()->route('user.transactions.show', $transaction->id);
    }
}
