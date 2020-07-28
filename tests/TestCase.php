<?php

namespace Stanbridge\VisualException\Tests;

use Stanbridge\VisualException\VisualExceptionServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();

        $this->withFactories(__DIR__.'/database/factories');
    }

    protected function getPackageProviders($app)
    {
        return [
            VisualExceptionServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
    }
}
