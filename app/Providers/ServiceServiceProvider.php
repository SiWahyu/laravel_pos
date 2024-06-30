<?php

namespace App\Providers;

use App\Services\AuthService;
use App\Services\ProdukService;
use App\Services\CustomerService;
use App\Services\KategoriService;
use App\Services\Impl\AuthServiceImpl;
use Illuminate\Support\ServiceProvider;
use App\Services\Impl\ProdukServiceImpl;
use App\Services\Impl\CustomerServiceImpl;
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
        $this->app->bind(ProdukService::class, function ($app) {
            return new ProdukServiceImpl();
        });
        $this->app->bind(AuthService::class, function ($app) {
            return new AuthServiceImpl();
        });
        $this->app->bind(CustomerService::class, function ($app) {
            return new CustomerServiceImpl();
        });
    }
}
