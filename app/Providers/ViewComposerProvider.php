<?php

namespace App\Providers;

use App\Http\View\Composers\CachedClientsList;
use App\Http\View\Composers\CachedCompaniesList;
use App\Http\View\Composers\CachedProductsList;
use App\Http\View\Composers\CachedTypesDocumentsList;
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
            'invoiceProduct.create',
            CachedProductsList::class,
            CachedCompaniesList::class,
            CachedClientsList::class
        );
        View::composer(
            'client.__form',
            CachedTypesDocumentsList::class
        );
    }
}
