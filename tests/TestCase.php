<?php

namespace Stanbridge\VisualException\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Stanbridge\VisualException\VisualExceptionServiceProvider;

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
