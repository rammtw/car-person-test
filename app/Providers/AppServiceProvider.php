<?php

declare(strict_types=1);

namespace App\Providers;

use App\Contracts\Service\CarServiceContract;
use App\Services\CarService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CarServiceContract::class, CarService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    }
}
