<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PromoCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PromoCodeController extends Controller
{
    /**
     * Validasi kode promo
     */
    public function checkCode(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
            'amount' => 'required|numeric|min:0',
        ]);

        $promoCode = PromoCode::where('code', strtoupper($request->code))->first();

        if (!$promoCode) {
            return response()->json([
                'valid' => false,
                'message' => 'Kode promo tidak ditemukan.',
            ], 404);
        }

        $userId = Auth::id();
        $validation = $promoCode->isValid($userId, $request->amount);

        if (!$validation['valid']) {
            return response()->json($validation, 400);
        }

        $discountAmount = $promoCode->calculateDiscount($request->amount);
        $finalAmount = $request->amount - $discountAmount;

        return response()->json([
            'valid' => true,
            'message' => $validation['message'],
            'promo_code' => [
                'id' => $promoCode->id,
                'code' => $promoCode->code,
                'name' => $promoCode->name,
                'discount_type' => $promoCode->discount_type,
                'discount_value' => $promoCode->discount_value,
            ],
            'original_amount' => $request->amount,
            'discount_amount' => $discountAmount,
            'final_amount' => $finalAmount,
        ]);
    }
}
