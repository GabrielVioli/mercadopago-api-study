<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;


class MercadoPagoServiceApi {

    protected string $token;
    protected string $url_api;

    public function __construct() {
        $this->token = config('services.token_mercado_pago.token');
        $this->url_api = config('services.token_mercado_pago.url');
    }


    public function createPreference($title, $quantity, $unit_price) {

    $data = [
        "items" => [
            [
            "title" => $title,
            "quantity" => (int) $quantity,
            "unit_price" => (float) $unit_price
            ]
        ],
    ];

        $response = Http::withToken($this->token)
        ->post($this->url_api, $data);



        return $response->json();
    }

}