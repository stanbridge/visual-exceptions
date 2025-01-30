<?php

namespace Stanbridge\VisualException\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;

class VisualExceptionController extends Controller
{
    public function __invoke(Request $request)
    {
        $output = Storage::disk('local')->get(config('visual-exceptions.storage'));

        $clearSetting = config('visual-exceptions.clear_on_retrieve');

        $shouldClear =
            $clearSetting === true ||
            ($clearSetting === 'upon-request' && $request->boolean('clear'));

        if ($shouldClear) {
            Storage::delete(config('visual-exceptions.storage'));
        }

        return response($output);
    }
}
