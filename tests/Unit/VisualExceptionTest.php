<?php

namespace Austinw\VisualException\Tests\Unit;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Austinw\VisualException\Tests\TestCase;
use Austinw\VisualException\VisualException;

class VisualExceptionTest extends TestCase
{
    public function test_it_can_capture_an_exception_response()
    {
        Config::set('visual-exceptions.enabled', true);

        Storage::fake('local');

        $response = new Response('Test Response');

        VisualException::capture($response);

        Config::set('visual-exceptions.storage', 'visual-exceptions/latest.html');

        Storage::assertExists(config('visual-exceptions.storage'));

        $file = Storage::get(config('visual-exceptions.storage'));

        self::assertEquals('Test Response', $file);
    }

    public function test_it_does_not_capture_exceptions_if_it_is_turned_off()
    {
        Config::set('visual-exceptions.enabled', false);

        Storage::fake('local');

        $response = new Response('Test Response');

        VisualException::capture($response);

        Config::set('visual-exceptions.storage', 'visual-exceptions/latest.html');

        Storage::assertMissing(config('visual-exceptions.storage'));
    }
}
