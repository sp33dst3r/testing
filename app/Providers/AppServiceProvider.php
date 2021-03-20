<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Observers\OrganisationObserver;
use App\Organisation;

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
        Organisation::observe(OrganisationObserver::class);
    }
}
