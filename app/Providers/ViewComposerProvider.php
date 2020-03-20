<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Http\View\Composers\CachedRolesList;
use App\Http\View\Composers\CachedProductsList;
use App\Http\View\Composers\CachedTypesDocumentsList;

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
        );
        View::composer(
            'client.__form',
            CachedTypesDocumentsList::class
        );
        View::composer(
            'auth.register',
            CachedRolesList::class,
        );
        View::composer(
            'user.edit',
            CachedRolesList::class,
        );
    }
}
