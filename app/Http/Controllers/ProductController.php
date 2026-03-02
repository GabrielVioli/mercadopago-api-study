<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; 
use App\Http\Requests\ProductValidateRequest;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allProducts = Product::all();

        return response()->json([
            "message" => "ok",
            "data" => $allProducts
        ], 200);

    }

    public function store(ProductValidateRequest $request)
    {
        Product::create($request->validated());

        return response()->json([
            "message" => "ok",
            "data" => $request->all()
        ], 201);
    }


    public function show(string $id)
    {
        $product = Product::findOrFail($id);

        return response()->json([
            "Status" => "ok",
            "data" => $product
        ], 200);
    }


    public function update(ProductValidateRequest $request, string $id)
    {
        $validateData = $request->validated();
        $product = Product::find($id); #nao usei o findOrFail devido a nao gostar da saida
        if(!$product) {
            return response()->json([
                "message" => "Not found",
            ], 400);
        }

        $product->update($validateData);
        return response()->json([
            "message" => "ok",
            "data" => $validateData
        ], 201);
    }


    public function destroy(string $id)
    {
        $product = Product::find($id);

        if($product) { 
            $product->delete();
            return response()->json([
                "message" => "ok",
            ], 200);
        }

        return response()->json([
            "message" => "not found",
        ], 400);
    }
}
