<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class AccountBalanceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'top_up_balance' => 'required|numeric',
            'payment_method' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'top_up_balance' => __('account_balance.top_up_balance'),
            'payment_method' => 'Metode Pembayaran',
        ];
    }
}
