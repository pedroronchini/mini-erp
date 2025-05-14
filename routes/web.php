<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\WebhookController;
use Illuminate\Support\Facades\Route;

// routes/web.php
Route::get('/products',[ProductsController::class,'index'])->name('products.index');
Route::post('/products',[ProductsController::class,'store'])->name('products.store');
Route::put('/products/{id}',[ProductsController::class,'update'])->name('products.update');

Route::post('/cart/add/{product}', [CartController::class,'add'])->name('cart.add');
Route::get('/cart', [CartController::class,'show'])->name('cart.show');
Route::post('/cart/apply-coupon', [CartController::class,'applyCoupon'])->name('cart.coupon');
Route::post('/cart/checkout', [CartController::class,'checkout'])->name('cart.checkout');

// Webhook
Route::post('/webhook/order',[WebhookController::class,'handle']);
