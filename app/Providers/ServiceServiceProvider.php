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
            return new AuthServiceImpl($app->make(\App\Services\UserService::class), $app->make(CustomerService::class));
        });
        $this->app->bind(CustomerService::class, function ($app) {
            return new CustomerServiceImpl();
        });
        $this->app->bind(\App\Services\KaryawanService::class, function ($app) {
            return new \App\Services\Impl\KaryawanServiceImpl($app->make(\App\Services\UserService::class));
        });
        $this->app->bind(\App\Services\RoleService::class, function ($app) {
            return new \App\Services\Impl\RoleServiceImpl();
        });
        $this->app->bind(\App\Services\UserService::class, function ($app) {
            return new \App\Services\Impl\UserServiceImpl();
        });
        $this->app->bind(\App\Services\CartService::class, function ($app) {
            return new \App\Services\Impl\CartServiceImpl();
        });
        $this->app->bind(\App\Services\CartItemService::class, function ($app) {
            return new \App\Services\Impl\CartItemServiceImpl();
        });
    }
}