<?php

namespace App\Providers;

use Dnetix\Redirection\PlacetoPay;
use Illuminate\Support\ServiceProvider;

class PlacetopayProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(PlacetoPay::class, function ($app) {
            return new PlacetoPay([
                'login' => config('placetoplay.login'),
                'tranKey' => config('placetoplay.trankey'),
                'url' => config('placetoplay.url'),
            ]);
        });
    }
}
