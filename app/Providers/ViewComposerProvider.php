<?php

namespace App\Providers;

use App\Http\View\Composers\{CachedClientsList, CachedCompaniesList, CachedProductsList};
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewComposerProvider extends ServiceProvider
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
        View::composer(
            'invoice.__form', CachedClientsList::class
        );

        View::composer(
            'invoice.__form', CachedCompaniesList::class
        );
        View::composer(
            'invoiceProduct.create', CachedProductsList::class, CachedCompaniesList::class, CachedClientsList::class
        );
    }
}
