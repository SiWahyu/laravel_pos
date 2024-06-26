<?php

namespace App\Providers;

use App\Services\KategoriService;
use Illuminate\Support\ServiceProvider;
use App\Services\Impl\KategoriServiceImpl;

class ServiceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app->bind(KategoriService::class, function ($app) {
            return new KategoriServiceImpl();
        });
    }
}