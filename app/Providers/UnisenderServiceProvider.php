<?php

namespace App\Providers;

use App\Services\Unisender\Contracts\Unisender as UnisenderContract;
use App\Services\Unisender\Unisender;
use Illuminate\Support\ServiceProvider;

class UnisenderServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(UnisenderContract::class, function () {
            return new Unisender(
                config('services.unisender.key')
            );
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
