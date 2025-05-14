<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\WebhookController;
use Illuminate\Support\Facades\Route;

// routes/web.php
Route::get('/produtos',[ProductsController::class,'index'])->name('products.index');
Route::post('/produtos',[ProductsController::class,'store'])->name('products.store');
Route::put('/produtos/{id}',[ProductsController::class,'update'])->name('products.update');

Route::post('/cart/add/{id}',[CartController::class,'add'])->name('cart.add');
Route::get('/cart',[CartController::class,'index'])->name('cart.index');
Route::post('/cart/checkout',[CartController::class,'checkout'])->name('cart.checkout');
Route::post('/cart/apply-coupon',[CartController::class,'applyCoupon'])->name('cart.applyCoupon');

// Webhook
Route::post('/webhook/order',[WebhookController::class,'handle']);
