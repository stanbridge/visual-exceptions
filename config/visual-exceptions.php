<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Master Switch
    |--------------------------------------------------------------------------
    |
    | This option may be used to completely disable visual exceptions.
    |
    */

    'enabled' => env('VISUAL_EXCEPTIONS_ENABLED', env('APP_DEBUG', true)),

    /*
    |--------------------------------------------------------------------------
    | Path
    |--------------------------------------------------------------------------
    |
    | This is the URI path where visual exceptions will be accessible from.
    |
    */

    'path' => env('VISUAL_EXCEPTIONS_PATH', 'api/visual-exceptions'),

    /*
    |--------------------------------------------------------------------------
    | Storage
    |--------------------------------------------------------------------------
    |
    | This is where the temporary exception output will be stored.
    |
    */

    'storage' => 'visual-exceptions/latest.html',

    /*
    |--------------------------------------------------------------------------
    | Clear on Retrieve
    |--------------------------------------------------------------------------
    |
    | Use this option to clear the exception file after retrieving it.
    |
    */

    'clear_on_retrieve' => env('VISUAL_EXCEPTIONS_CLEAR', true),

    /*
    |--------------------------------------------------------------------------
    | Middleware
    |--------------------------------------------------------------------------
    |
    | Set middleware on the route.
    |
    */

    'middleware' => ['api'],
];
