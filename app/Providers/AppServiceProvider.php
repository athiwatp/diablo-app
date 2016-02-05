<?php

namespace App\Providers;

use Log;
use Menu;
use Cache;
use Queue;
use Config;
use App\Ladder;
use johnleider\BattleNet\Diablo;
use Illuminate\Support\ServiceProvider;
use Illuminate\Queue\Events\JobProcessed;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('structure::left-sidebar', function ($view) {
            $menu = Menu::schema('structure-menu.schema')
                ->parse(Config::get('structure-menu.menu'));

            $view->with(compact('menu'));
        });

        Queue::after(function (JobProcessed $event) {
            //
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
