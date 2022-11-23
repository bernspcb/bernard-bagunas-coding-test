<?php

namespace App\Providers;

use App\Models\Product;
use Laravel\Sanctum\Sanctum;
use App\Observers\ProductsObserver;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // remove sanctum migrations
        Sanctum::ignoreMigrations();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Product::observe(ProductsObserver::class);
    }
}
