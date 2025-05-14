<?php

namespace App\Http\Controllers;

use App\Mail\OrderPlaced;
use App\Models\Cupons;
use App\Models\Orders;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{
    public function add($productId)
    {
        $cart = session('cart', []);

        $cart[$productId] = ($cart[$productId] ?? 0) + 1;

        session(['cart' => $cart]);

        return back();
    }

    public function index()
    {
        $cartItems = session('cart', []);

        $products = Products::whereIn('id', array_keys($cartItems))->get();

        return view('cart.index', compact('products', 'cartItems'));
    }

    public function checkout(Request $request)
    {
        $cartItems = session('cart', []);

        $products = Products::whereIn('id', array_keys($cartItems))->get();

        $items = [];
        $subtotal = 0;

        foreach ($products as $product) {
            $qty = $cartItems[$product->id];
            $items[] = ['name' => $product->name, 'quantity' => $qty, 'price' => $product->price];
            $subtotal += $product->price * $qty;

            $stock = $product->stocks()->whereNull('variation')->first();
            $stock->decrement('quantity', $qty);
        }

        if ($subtotal >= 52 && $subtotal <= 166.59) {
            $shipping = 15;
        } elseif ($subtotal > 200) {
            $shipping = 0;
        } else {
            $shipping = 20;
        }

        if ($coupon = session('coupon')) {
            if ($subtotal >= $coupon['min_subtotal']) {
                $subtotal -= $coupon['discount'];
            }
        }

        $order = Orders::create([
            'items' => $items,
            'subtotal' => $subtotal,
            'shipping' => $shipping,
            'total' => $subtotal + $shipping,
            'delivery_address' => $request->delivery_address,
        ]);

        Mail::to($request->email)->send(new OrderPlaced($order));

        session()->forget(['cart', 'coupon']);

        return view('cart.success', compact('order'));
    }

    public function applyCoupon(Request $request)
    {
        $coupon = Cupons::where('code', $request->code)->first();

        if ($coupon && $coupon->expires_at >= now()->toDateString()) {
            session(['coupon' => $coupon->toArray()]);

            return back()->with('success', 'Coupon applied successfully.');
        }
        return back()->with('error', 'Invalid coupon.');
    }
}
