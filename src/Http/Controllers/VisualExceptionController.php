<?php


namespace Austinw\VisualException\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

class VisualExceptionController extends Controller
{
    public function __invoke()
    {
        $output = Storage::disk('local')->get(config('visual-exceptions.storage'));

        if (config('visual-exceptions.clear_on_retrieve')) {
            Storage::delete(config('visual-exceptions.storage'));
        }

        return response($output);
    }
}
