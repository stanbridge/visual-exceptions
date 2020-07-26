<?php

namespace AustinW\VisualException\Tests\Feature\Http\Controllers;

use AustinW\VisualException\Tests\TestCase;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;

class VisualExceptionControllerTest extends TestCase
{
    public function test_it_can_return_a_stored_exception()
    {
        Storage::fake('local');

        Storage::put(config('visual-exceptions.storage'), 'Test Exception Response');

        $this->get('api/visual-exceptions/latest')->assertSuccessful()->assertSee('Test Exception Response');
    }

    public function test_it_can_delete_the_exception_file_after_returning_it()
    {
        Storage::fake('local');

        Config::set('visual-exceptions.clear_on_retrieve', true);

        Storage::put(config('visual-exceptions.storage'), 'Test Exception Response');

        $this->get('api/visual-exceptions/latest')->assertSuccessful()->assertSee('Test Exception Response');

        Storage::assertMissing(config('visual-exceptions.storage'));
    }
}
