<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class PayPalController extends Controller
{
    //

    public function index()
    {
        return view('usuario.checkout');
    }

    private function getAccessToken() {
        $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Authorization' => 'Basic ' . base64_encode(config('paypal_client_id').':'. config('paypal_client_secret'))
        ];

        $response = Http::withHeaders($headers)
        ->withBody('grant_type=client_credentials')
        ->post(config('paypal.base_url').'/v1/oauth2/token');

        return json_decode($response->body())->access_token;
    }

    public function create(int $amount = 10)
    {
        $id = uuid_create();

        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '. $this->getAccessToken(),
            'PayPal-Request-Id' => $id,
            
        ];

        $body = [
            "intent" => "CAPTURE",
            "purchase_units" => [
                "reference_id" => $id,
                "amount" => [
                    "currency_code"=>"USD", 
                    "value" => number_format($amount, 2),

                ]
            ]
            
        ];
        $response = Http::withHeaders($headers)
        ->withBody(json_encode($body))
        ->post(config('paypal.base_url').'/v2/checkout/orders');

        Session::put('request_id', $id);
        Session::put('order_id', json_decode($response->body())->id);

        return json_decode($response->body())->id;
    }

    public function complete()
    {
        $url = config('paypal.base_url') . '/v2/checkout/orders/' . Session::get('order_id') . '/capture';
    
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $this->getAccessToken(),
        ];
        
        $response = Http::withHeaders($headers)
        ->post($url);

        return json_decode($response->body());
    }
    
    

}
