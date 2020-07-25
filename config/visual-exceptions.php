<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Visual Exceptions Path
    |--------------------------------------------------------------------------
    |
    | This is the URI path where visual exceptions will be accessible from.
    |
    */

    'path' => env('VISUAL_EXCEPTIONS_PATH', 'api/visual-exceptions'),

    'storage' => 'visual-exceptions/latest.html',

    'clear_on_retrieve' => env('VISUAL_EXCEPTIONS_CLEAR', true),

    'middleware' => ['api'],

    /*
    |--------------------------------------------------------------------------
    | Visual Exceptions Master Switch
    |--------------------------------------------------------------------------
    |
    | This option may be used to completely disable visual exceptions.
    |
    */

    'enabled' => env('VISUAL_EXCEPTIONS_ENABLED', true),
];
