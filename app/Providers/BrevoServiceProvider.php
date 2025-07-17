<?php

namespace App\Providers;

use App\Services\BrevoService;
use GuzzleHttp\Client;use Illuminate\Support\ServiceProvider;

class BrevoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
        $this->app->singleton(BrevoService::class, function ($app) {
            return BrevoService::create();
        });

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
