<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/product', [ProductController::class, "store"])->name('product.create');
Route::get('/product/{id}', [ProductController::class, "show"])->name('product.show');
Route::put('/product/{id}', [ProductController::class, "update"])->name('product.update');
Route::delete('product/{id}', [ProductController::class, "destroy"])->name('product.delete');