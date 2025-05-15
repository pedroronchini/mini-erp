<?php

namespace App\Http\Controllers;

use App\Models\Cupons;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Cupons::orderBy('expires_at')->get();
        return view('coupons.index', compact('coupons'));
    }

    public function create()
    {
        return view('coupons.create');
    }

    public function store(Request $req)
    {
        $data = $req->validate([
            'code'         => 'required|string|unique:cupons,code',
            'type'         => 'required|in:fixed,percent',
            'value'        => 'required|numeric|min:0',
            'min_subtotal' => 'required|numeric|min:0',
            'expires_at'   => 'required|date|after:today',
        ]);
        Cupons::create($data);
        return redirect()->route('coupons.index')
            ->with('success', 'Cupom criado!');
    }

    public function edit(Cupons $coupon)
    {
        return view('coupons.edit', compact('coupon'));
    }

    public function update(Request $req, Cupons $coupon)
    {
        $data = $req->validate([
            'code'         => 'required|string|unique:cupons,code,' . $coupon->id,
            'type'         => 'required|in:fixed,percent',
            'value'        => 'required|numeric|min:0',
            'min_subtotal' => 'required|numeric|min:0',
            'expires_at'   => 'required|date|after:today',
        ]);
        $coupon->update($data);
        return redirect()->route('coupons.index')
            ->with('success', 'Cupom atualizado!');
    }

    public function destroy(Cupons $coupon)
    {
        $coupon->delete();
        return redirect()->route('coupons.index')
            ->with('success', 'Cupom removido!');
    }
}
