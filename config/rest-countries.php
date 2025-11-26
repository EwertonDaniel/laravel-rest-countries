<?php

return [
    'base_url' => env('REST_COUNTRIES_URL', 'https://restcountries.com/v3.1'),
    'log_channel' => env('REST_COUNTRIES_LOG_CHANNEL', 'stack'),
    'http' => [
        'verify' => env('REST_COUNTRIES_HTTP_VERIFY', false),
        'timeout' => env('REST_COUNTRIES_HTTP_TIMEOUT', 30),
    ],
];
