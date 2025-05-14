<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Products::with('stocks')->get();
        return view('index', compact('products'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'variations' => 'nullable|array',
            'variations.*' => 'string',
            'quantity' => 'required|integer',
            'variation' => 'nullable|string',
        ]);

        $product = Products::create([
            'name' => $data['name'],
            'price' => $data['price'],
            'variations' => $data['variations'] ?? [],
        ]);

        $product->stocks()->create([
            'variation' => $data['variation'] ?? null,
            'quantity' => $data['quantity'],
        ]);

        return back()->with('success', 'Product created successfully.');
    }

    public function update($id, Request $request)
    {
        $product = Products::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
        ]);

        $product->update($validated);

        if ($request->has('quantity')) {
            $stock = $product->stocks()->first();
            $stock->update(['quantity' => $request->quantity]);
        }

        return back()->with('success', 'Product updated successfully.');
    }
}
