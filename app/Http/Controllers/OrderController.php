<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Http\Requests\OrderValidateRequest;
use App\Services\MercadoPagoServiceApi;


class OrderController extends Controller
{
    public function store(OrderValidateRequest $request, MercadoPagoServiceApi $apiService)
    {
        $validateData = $request->validated();

        $product = Product::findOrFail($validateData['product_id']);


        $api = $apiService->createPreference($product->name,
                                             $validateData['quantity'],
                                             $product->unit_price);

        return response()->json([
            'message' => 'ok',
            'data' => [
                'checkout_url' => $api['init_point'],
                'sandbox_url' => $api['sandbox_init_point']
            ]
        ], 201);
    }



}
