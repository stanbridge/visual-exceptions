<?php

namespace Austinw\VisualException;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class VisualExceptionServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot() : void
    {
        if (! config('visual-exceptions.enabled')) {
            return;
        }

        $this->registerRoutes();
        $this->registerPublishing();
    }

    /**
     * Register the package routes.
     *
     * @return void
     */
    private function registerRoutes() : void
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__.'/Http/routes.php');
        });
    }

    /**
     * Get the Telescope route group configuration array.
     *
     * @return array
     */
    private function routeConfiguration() : array
    {
        return [
            'prefix' => config('visual-exceptions.path'),
            'middleware' => config('visual-exceptions.middleware'),
        ];
    }

    /**
     * Register the package's publishable resources.
     *
     * @return void
     */
    private function registerPublishing() : void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../public' => public_path('vendor/visual-exceptions'),
            ], 'visual-exceptions-assets');

            $this->publishes([
                __DIR__.'/../config/visual-exceptions.php' => config_path('visual-exceptions.php'),
            ], 'visual-exceptions-config');
        }
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/visual-exceptions.php',
            'visual-exceptions'
        );
    }
}
