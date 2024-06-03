<?php

namespace App\Http\Controllers;

use App\Events\ReservaExpirada;
use App\Models\Payment;
use App\Models\Reservacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Exception;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Stmt\TryCatch;

class PayPalController extends Controller
{
    //

    public function index()
    {
        return view('usuario.checkout');
    }
    public function createTransaction($idreservacion)
    {
        $paypal = new PayPalClient;
        $paypal->setApiCredentials(config('paypal'));
        $token = $paypal->getAccessToken();

        // return $token;
        $paypal->setAccessToken($token);


        //aqui va el query para el precio de la reserva
        //  $precio = 120.99;
          $precioreserva = Reservacion::select('MontoTotal', 'fecha_expiracion')->where('IdReservacion', $idreservacion)->first()->MontoTotal;
        
         

        // $montoTotal = (double) $precioreserva->MontoTotal;

        $order = $paypal->createOrder([
            "intent" => "CAPTURE",
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $precioreserva,
                    ]
                ]
            ],
            "application_context" => [
                "return_url" => route('captureTransaction', ['idreservacion' => $idreservacion]),
                "cancel_url" => route('cancelTransaction'),
            ]
        ]);

        return redirect()->away($order['links'][1]['href']);
    }

    public function captureTransaction(Request $request, $idreservacion)
    {

        try {

        
        $paypal = new PayPalClient;
        $paypal->setApiCredentials(config('paypal'));
        $token = $paypal->getAccessToken();

        $paypal->setAccessToken($token);

        // PayPal devuelve el token en el parámetro `token`
        $order_id = $request->query('token');

        // Verificar si el order_id es válido
        if (!$order_id) {
            return redirect()->route('home')->with('error', 'Transacción no válida.');
        }

        $result = $paypal->capturePaymentOrder($order_id);

        // return $result;
        if ($result['status'] == 'COMPLETED') {
            $paymentData = [
                'payment_id' => $result['id'],
                'payer_id' => $result['payer']['payer_id'],
                'payer_email' => $result['payer']['email_address'],
                'amount' => $result['purchase_units'][0]['payments']['captures'][0]['amount']['value'],
                'currency' => $result['purchase_units'][0]['payments']['captures'][0]['amount']['currency_code'],
                'status' => $result['status'],
            ];

            Payment::create($paymentData);

            //aqui se redirige a lo que se quiere ver cuando se complete el pago 
            // return view('payment_success', compact('result'));
            return redirect()->route('Reservacion.pagado', ['idreservacion' => $idreservacion]);
        }

        return redirect()->route('inicio')->with('error', 'Error al capturar el pago.');
    }catch (Exception $e) {
        Log::error($e->getMessage());
        return redirect()->route('inicio')->with('error', 'Error al capturar el pago.');
    }

    }

    public function cancelTransaction()
    {
        return redirect()->route('inicio')->with('error', 'Has cancelado tu transacción.');
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
