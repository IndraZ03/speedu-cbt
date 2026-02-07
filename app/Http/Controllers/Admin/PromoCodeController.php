<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PromoCode;
use Illuminate\Http\Request;

class PromoCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $promoCodes = PromoCode::query()
            ->when($request->search, function ($query, $search) {
                return $query->where('code', 'like', '%' . $search . '%')
                    ->orWhere('name', 'like', '%' . $search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return inertia('Admin/PromoCode/Index', [
            'promoCodes' => $promoCodes,
            'filters' => $request->only(['search'])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Admin/PromoCode/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:50|unique:promo_codes,code',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'discount_type' => 'required|in:percentage,fixed',
            'discount_value' => 'required|numeric|min:0',
            'min_purchase' => 'nullable|numeric|min:0',
            'max_discount' => 'nullable|numeric|min:0',
            'usage_limit' => 'nullable|integer|min:1',
            'usage_limit_per_user' => 'required|integer|min:1',
            'valid_from' => 'nullable|date',
            'valid_until' => 'nullable|date|after_or_equal:valid_from',
            'is_active' => 'boolean',
        ]);

        // Uppercase the code
        $validated['code'] = strtoupper($validated['code']);

        PromoCode::create($validated);

        session()->flash('success', 'Kode promo berhasil dibuat.');
        return redirect()->route('admin.promo-codes.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $promoCode = PromoCode::findOrFail($id);

        return inertia('Admin/PromoCode/Edit', [
            'promoCode' => $promoCode
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $promoCode = PromoCode::findOrFail($id);

        $validated = $request->validate([
            'code' => 'required|string|max:50|unique:promo_codes,code,' . $id,
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'discount_type' => 'required|in:percentage,fixed',
            'discount_value' => 'required|numeric|min:0',
            'min_purchase' => 'nullable|numeric|min:0',
            'max_discount' => 'nullable|numeric|min:0',
            'usage_limit' => 'nullable|integer|min:1',
            'usage_limit_per_user' => 'required|integer|min:1',
            'valid_from' => 'nullable|date',
            'valid_until' => 'nullable|date|after_or_equal:valid_from',
            'is_active' => 'boolean',
        ]);

        // Uppercase the code
        $validated['code'] = strtoupper($validated['code']);

        $promoCode->update($validated);

        session()->flash('success', 'Kode promo berhasil diperbarui.');
        return redirect()->route('admin.promo-codes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $promoCode = PromoCode::findOrFail($id);
        $promoCode->delete();

        return redirect()->route('admin.promo-codes.index');
    }
}
