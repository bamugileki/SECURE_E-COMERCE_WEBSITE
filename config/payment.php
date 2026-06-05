<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Payment Gateway
    |--------------------------------------------------------------------------
    |
    | This option controls the default payment gateway that will be used
    | when processing payments. You may set this to any of the gateways
    | defined in the "gateways" configuration below.
    |
    | Supported: "stripe", "paypal", "flutterwave", "mock"
    |
    */

    'default' => env('PAYMENT_DEFAULT', 'mock'),

    /*
    |--------------------------------------------------------------------------
    | Payment Gateways
    |--------------------------------------------------------------------------
    |
    | Here you may configure the payment gateways for your application.
    | You can add as many as you want and enable/disable them as needed.
    |
    */

    'gateways' => [

        'stripe' => [
            'enabled' => env('STRIPE_ENABLED', true),
        ],

        'paypal' => [
            'enabled' => env('PAYPAL_ENABLED', false),
            'client_id' => env('PAYPAL_CLIENT_ID'),
            'secret' => env('PAYPAL_SECRET'),
            'mode' => env('PAYPAL_MODE', 'sandbox'),
        ],

        'flutterwave' => [
            'enabled' => env('FLUTTERWAVE_ENABLED', false),
            'secret_key' => env('FLUTTERWAVE_SECRET_KEY'),
            'public_key' => env('FLUTTERWAVE_PUBLIC_KEY'),
            'mode' => env('FLUTTERWAVE_MODE', 'sandbox'),
        ],

        'mock' => [
            'enabled' => env('MOCK_PAYMENT_ENABLED', true),
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Currency
    |--------------------------------------------------------------------------
    |
    | This option controls the default currency used for payments.
    |
    */

    'currency' => env('PAYMENT_CURRENCY', 'TZS'),

    /*
    |--------------------------------------------------------------------------
    | TZS to USD Conversion Rate
    |--------------------------------------------------------------------------
    |
    | Stripe requires a minimum charge of $0.50 USD. When using TZS,
    | the amount is converted to USD for Stripe processing.
    | Update this rate based on current exchange rates.
    |
    */

    'tzs_to_usd_rate' => env('TZS_TO_USD_RATE', 2400),

];
