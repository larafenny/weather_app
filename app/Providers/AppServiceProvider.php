<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\WeatherService;
use App\Interfaces\WeatherInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(WeatherInterface::class, WeatherService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
