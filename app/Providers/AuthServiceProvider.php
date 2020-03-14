<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Client' => 'App\Policies\ClientPolicy',
        'App\Company' => 'App\Policies\CompanyPolicy',
        'App\Product' => 'App\Policies\ProductPolicy',
        'App\Invoice' => 'App\Policies\InvoicePolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
