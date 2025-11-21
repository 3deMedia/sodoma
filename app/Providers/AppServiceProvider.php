<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
// use Laravel\Cashier\Cashier;

use Illuminate\Support\Facades\Blade;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Cashier::calculateTaxes();
        Schema::defaultStringLength(191);

    }
}
