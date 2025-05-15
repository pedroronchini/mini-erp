<?php

namespace App\Http\Controllers;

use App\Mail\OrderPlaced;
use App\Models\Cupons;
use App\Models\Orders;
use App\Models\Products;
use App\Models\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{

    protected function calcShipping($subtotal)
    {
        if ($subtotal >= 200) return 0;
        if ($subtotal >= 52 && $subtotal <= 166.59) return 15;
        return 20;
    }

    public function add(Request $req, Products $product)
    {
        $cart = session()->get('cart', []);
        $variation = $req->input('variation');
        $key = $product->id . '_' . $variation;
        $qty = ($cart[$key]['qty'] ?? 0) + 1;

        // checar estoque
        $stock = $product->storages()
            ->where('variation', $variation)->first();
        if (!$stock || $qty > $stock->quantity) {
            return back()->with('error', 'Sem estoque!');
        }

        $cart[$key] = [
            'product_id' => $product->id,
            'name' => $product->name,
            'variation' => $variation,
            'price' => $product->price,
            'qty' => $qty
        ];
        session(['cart' => $cart]);
        return back();
    }

    public function show()
    {
        $cart = session('cart', []);
        $subtotal = collect($cart)->sum(fn($i) => $i['price'] * $i['qty']);
        $shipping = $this->calcShipping($subtotal);
        return view('cart.index', compact('cart', 'subtotal', 'shipping'));
    }

    public function applyCoupon(Request $req)
    {
        $code = $req->input('code');
        $coupon = Cupons::where('code', $code)
            ->where('expires_at', '>=', now())
            ->firstOrFail();
        $subtotal = collect(session('cart'))->sum(fn($i) => $i['price'] * $i['qty']);
        if ($subtotal < $coupon->min_subtotal) {
            return back()->with('error', 'Subtotal mínimo não atingido');
        }
        session(['coupon' => $coupon->toArray()]);
        return back();
    }

    public function checkout(Request $req)
    {
        $cart = session('cart', []);
        $subtotal = collect($cart)->sum(fn($i) => $i['price'] * $i['qty']);
        $shipping = $this->calcShipping($subtotal);
        $discount = 0;
        if ($coupon = session('coupon')) {
            $discount = $coupon['type'] == 'fixed'
                ? $coupon['value']
                : $subtotal * ($coupon['value'] / 100);
        }
        $total = $subtotal + $shipping - $discount;

        $order = Orders::create([
            'items' => $cart,
            'subtotal' => $subtotal,
            'shipping_cost' => $shipping,
            'total' => $total,
            'customer_name' => $req->input('name'),
            'customer_email' => $req->input('email'),
            'address' => $req->input('address'),
        ]);

        // atualizar estoque
        foreach ($cart as $item) {
            Storage::where('product_id', $item['product_id'])
                ->where('variation', $item['variation'])
                ->decrement('quantity', $item['qty']);
        }

        session()->forget(['cart', 'coupon']);
        return view('cart.success', compact('order'));
    }
}
