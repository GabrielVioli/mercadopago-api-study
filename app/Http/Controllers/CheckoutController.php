<?php

namespace App\Http\Controllers;

use App\Services\MercadoPagoServiceApi;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    
    public function index() {
        return view('index');
    }


    public function process(MercadoPagoServiceApi $response, Request $request) {

        $response = $response->createPreference(
            $request->input('title'),
            $request->input('quantity'),
            $request->input('unit_price')
        );


        return redirect()->away($response['init_point']);
    }
}
