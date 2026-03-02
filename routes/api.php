<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;



Route::middleware('auth:sanctum')->group(function() {
    Route::get('/user/{id}', [UserController::class, "show"])->name("user.show");
    Route::put('/user/{id}', [UserController::class, "update"])->name('user.update');
    Route::delete('/user/{id}', [UserController::class, "destroy"])->name("user>delete");

    Route::get('/', [ProductController::class, "index"])->name("products.all");
    Route::post('/product', [ProductController::class, "store"])->name('product.create');
    Route::get('/product/{id}', [ProductController::class, "show"])->name('product.show');
    Route::put('/product/{id}', [ProductController::class, "update"])->name('product.update');
    Route::delete('product/{id}', [ProductController::class, "destroy"])->name('product.delete');

    Route::post('/order', [OrderController::class, "store"])->name('order.store');
});

Route::post('/cadastro', [UserController::class, "store"])->name("cadastro");
Route::post('/login', [UserController::class, "authenticate"])->name("login");