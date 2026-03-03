<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;

class UserProductController extends Controller
{
 
    public function index()
    {
        //produtos com os respectivos donos
        $products = Product::with('user')->get();
        
        return response()->json([
            "message" => "ok",
            "data" => $products
        ]);
    }

    public function show(string $id)
    {
       $user = User::findOrFail($id);

       $products = Product::where('user_id', $id)->get();

       return response()->json([
            "message" => "ok",
            "data" => $products,
       ]);
    }

}
