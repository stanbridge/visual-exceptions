<?php

namespace Austinw\VisualException;

use Illuminate\Support\Facades\Storage;

class VisualException
{
    public static function capture($response)
    {
        if (! config('visual-exceptions.enabled')) {
            return;
        }

        Storage::disk('local')->put(config('visual-exceptions.storage'), $response->content());
    }
}
