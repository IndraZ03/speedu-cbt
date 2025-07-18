<?php

namespace App\Models\Transaction;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class PaymentConfirmation extends Model
{
    use HasFactory, Uuid;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'transaction_id',
        'bank_id',
        'rekening_name',
        'transfer_date',
        'total_payment',
        'file',
        'transaction_id_account_balance',
    ];

    public function trasaction()
    {
        return $this->belongsTo(\App\Models\Transaction\Transaction::class);
    }

    public function accountBalance()
    {
        return $this->belongsTo(\App\Models\AccountBalance::class, 'transaction_id_account_balance', 'id');
    }

    public function bank()
    {
        return $this->belongsTo(\App\Models\Transaction\Bank::class)->withTrashed();
    }
}
