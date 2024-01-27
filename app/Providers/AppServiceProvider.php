<?php

namespace App\Providers;

use App\Services\OrderService;
use App\Services\OrderServiceInterface;
use App\Services\ProductService;
use App\Services\ProductServiceInterface;
use App\Services\UserService;
use App\Services\UserServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ProductServiceInterface::class, ProductService::class);
        $this->app->bind(OrderServiceInterface::class, OrderService::class);
        $this->app->bind(UserServiceInterface::class, UserService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
