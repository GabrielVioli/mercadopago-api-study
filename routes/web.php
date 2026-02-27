<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductController;

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');


Route::get('/produto', [ProductController::class, "create"])->name('produto.create');
Route::post('/produto', [ProductController::class, "store"])->name('produto.store');
