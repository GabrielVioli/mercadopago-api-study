<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Http\Requests\OrderValidateRequest;
use App\Services\MercadoPagoServiceApi;


class OrderController extends Controller
{
    public function store(OrderValidateRequest $request, MercadoPagoServiceApi $apiService)
    {
        $validated = $request->validated();
        $user = Auth::user();

        $product = Product::findOrFail($validated['product_id']);
        $quantity = $validated['quantity'];
        $unitPrice = $product->unit_price;
        $totalPrice = $unitPrice * $quantity;

        // create MercadoPago preference
        $api = $apiService->createPreference(
            $product->name,
            $quantity,
            $unitPrice
        );

        // save order record
        $order = Order::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'quantity' => $quantity,
            'unit_price' => $unitPrice,
            'total_price' => $totalPrice,
            'preference_id' => $api['id'] ?? null,
            'status' => 'pending',
        ]);

        return response()->json([
            'message' => 'ok',
            'data' => [
                'order' => $order,
                'checkout_url' => $api['init_point'],
                'sandbox_url' => $api['sandbox_init_point'],
            ]
        ], 201);
    }



}
