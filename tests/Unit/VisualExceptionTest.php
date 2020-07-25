<?php

namespace Austinw\VisualException\Tests\Unit;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Austinw\VisualException\Tests\TestCase;
use Austinw\VisualException\VisualException;

class VisualExceptionTest extends TestCase
{
    /** @test */
    public function it_can_capture_an_exception_response()
    {
        Storage::fake('local');

        $response = new Response('Test Response');

        VisualException::capture($response);

        Config::set('visual-exceptions.storage', 'visual-exceptions/latest.html');

        Storage::assertExists(config('visual-exceptions.storage'));

        $file = Storage::get(config('visual-exceptions.storage'));

        self::assertEquals('Test Response', $file);
    }
}
