<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\User\AccountBalanceRepository as AccountBalanceRepository;
use App\Models\Setting;
use App\Models\Transaction\PaymentConfirmation;
use App\Repositories\Transaction\BankRepository;

class AccountBalanceController extends Controller
{
    protected $accountBalanceRepository;

    public function __construct(accountBalanceRepository $accountBalanceRepository)
    {
        $this->accountBalanceRepository = $accountBalanceRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return inertia('Admin/User/AccountBalance/Index', [
            'accountBalances' => $this->accountBalanceRepository->getAllPaginatedWithParams($request)
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
        $accountBalance = $this->accountBalanceRepository->find($id);
        $paymentConfirmation = PaymentConfirmation::where('transaction_id_account_balance', $accountBalance->id)->With('bank')->first();

        // return $accountBalance;

        return inertia('Admin/User/AccountBalance/Show', [
            'payment_confirmation' => $paymentConfirmation,
            'accountBalance' => $accountBalance,
            'banks' => (new BankRepository())->all(),
            'setting' => (new Setting())->first(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $this->accountBalanceRepository->update($request, $id);
            return redirect()->route('admin.account-balances.index');
        } catch (\Exception $e) {
            session()->flash('failed', $e->getMessage() . ' in file :' . $e->getFile() . ' line: ' . $e->getLine());
            return redirect()->back()->withInput($request->all());
        }
    }
}
