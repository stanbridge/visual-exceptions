<?php

namespace Austinw\VisualException;

use Illuminate\Support\Facades\Storage;

class VisualException
{
    public static function capture($response)
    {
        Storage::disk('local')->put(config('visual-exceptions.storage'), $response->content());
    }
}
