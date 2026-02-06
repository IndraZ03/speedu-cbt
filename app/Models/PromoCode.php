<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PromoCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'description',
        'discount_type',
        'discount_value',
        'min_purchase',
        'max_discount',
        'usage_limit',
        'usage_limit_per_user',
        'used_count',
        'valid_from',
        'valid_until',
        'is_active',
    ];

    protected $casts = [
        'discount_value' => 'decimal:2',
        'min_purchase' => 'decimal:2',
        'max_discount' => 'decimal:2',
        'usage_limit' => 'integer',
        'usage_limit_per_user' => 'integer',
        'used_count' => 'integer',
        'valid_from' => 'date',
        'valid_until' => 'date',
        'is_active' => 'boolean',
    ];

    /**
     * Relationship dengan usage history
     */
    public function usages()
    {
        return $this->hasMany(PromoCodeUsage::class);
    }

    /**
     * Cek apakah promo code valid
     */
    public function isValid($userId = null, $purchaseAmount = 0)
    {
        // Cek status aktif
        if (!$this->is_active) {
            return ['valid' => false, 'message' => 'Kode promo tidak aktif.'];
        }

        // Cek tanggal validitas
        $today = Carbon::today();
        if ($this->valid_from && $today->lt($this->valid_from)) {
            return ['valid' => false, 'message' => 'Kode promo belum berlaku.'];
        }
        if ($this->valid_until && $today->gt($this->valid_until)) {
            return ['valid' => false, 'message' => 'Kode promo sudah kadaluarsa.'];
        }

        // Cek limit penggunaan total
        if ($this->usage_limit && $this->used_count >= $this->usage_limit) {
            return ['valid' => false, 'message' => 'Kode promo sudah mencapai batas penggunaan.'];
        }

        // Cek minimal pembelian
        if ($this->min_purchase && $purchaseAmount < $this->min_purchase) {
            return ['valid' => false, 'message' => 'Minimal pembelian Rp ' . number_format($this->min_purchase, 0, ',', '.') . ' untuk menggunakan kode ini.'];
        }

        // Cek limit penggunaan per user
        if ($userId && $this->usage_limit_per_user) {
            $userUsageCount = $this->usages()->where('user_id', $userId)->count();
            if ($userUsageCount >= $this->usage_limit_per_user) {
                return ['valid' => false, 'message' => 'Anda sudah menggunakan kode promo ini.'];
            }
        }

        return ['valid' => true, 'message' => 'Kode promo valid!'];
    }

    /**
     * Hitung jumlah diskon
     */
    public function calculateDiscount($amount)
    {
        if ($this->discount_type === 'percentage') {
            $discount = ($amount * $this->discount_value) / 100;
            
            // Apply max discount jika ada
            if ($this->max_discount && $discount > $this->max_discount) {
                $discount = $this->max_discount;
            }
        } else {
            // Fixed discount
            $discount = $this->discount_value;
        }

        // Pastikan diskon tidak melebihi total amount
        if ($discount > $amount) {
            $discount = $amount;
        }

        return $discount;
    }

    /**
     * Increment used count
     */
    public function incrementUsage()
    {
        $this->increment('used_count');
    }

    /**
     * Scope untuk promo aktif
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope untuk promo yang masih valid (berdasarkan tanggal)
     */
    public function scopeValidDate($query)
    {
        $today = Carbon::today();
        return $query->where(function ($q) use ($today) {
            $q->whereNull('valid_from')->orWhere('valid_from', '<=', $today);
        })->where(function ($q) use ($today) {
            $q->whereNull('valid_until')->orWhere('valid_until', '>=', $today);
        });
    }
}
