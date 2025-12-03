<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\VinManufacturerCatalog;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(VinManufacturerCatalog::class, function () {
            return VinManufacturerCatalog::fromConfig();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
