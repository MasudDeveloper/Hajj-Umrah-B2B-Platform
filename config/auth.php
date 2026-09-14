<?php

return [

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'agencies',
        ],
    ],

    'providers' => [
        'agencies' => [
            'driver' => 'eloquent',
            'model' => App\Models\Agency::class,
        ],
    ],

    'passwords' => [
        'agencies' => [
            'provider' => 'agencies',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,

];
