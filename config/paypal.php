<?php

return [
    'base_url' => env('PAYPAL_MODE', 'sandbox') == 'live' ? 'https://api-m.paypal.com' : 'https://api-m.sandbox.paypal.com',
    'mode' =>env('PAYPAL_MODE', 'sandbox'),
    'client_id' =>env('PAYPAL_CLIENT_ID'),
    'client_secret' =>env('PAYPAL_CLIENT_SECRET'),
    'currency' =>env('PAYPAL_CURRENCY', 'USD'),


    // 'mode'    => env('PAYPAL_MODE', 'sandbox'), // puede ser 'sandbox' o 'live'
    'sandbox' => [
        'client_id'         => env('PAYPAL_SANDBOX_CLIENT_ID', ''),
        'client_secret'     => env('PAYPAL_SANDBOX_CLIENT_SECRET', ''),
        'app_id'            => env('PAYPAL_SANDBOX_APP_ID', ''),
    ],
    'live' => [
        'client_id'         => env('PAYPAL_LIVE_CLIENT_ID', ''),
        'client_secret'     => env('PAYPAL_LIVE_CLIENT_SECRET', ''),
        'app_id'            => env('PAYPAL_LIVE_APP_ID', ''),
    ],

    'payment_action' => 'Sale', // 'Sale', 'Authorization', 'Order'
    // 'currency'       => env('PAYPAL_CURRENCY', 'USD'),
    'notify_url'     => env('PAYPAL_NOTIFY_URL', ''), // URL de notificación IPN
    'locale'         => env('PAYPAL_LOCALE', 'en_US'),
    'validate_ssl'   => env('PAYPAL_VALIDATE_SSL', false),
];
