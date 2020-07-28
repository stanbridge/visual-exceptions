<?php


namespace Stanbridge\VisualException\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;

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
