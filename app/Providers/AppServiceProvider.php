<?php

namespace App\Providers;

use App\Rankings\API\DiabloAPI;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('DiabloAPI', function () {
            return new DiabloAPI;
        });
    }
}
