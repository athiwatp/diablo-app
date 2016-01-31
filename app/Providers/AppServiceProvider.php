<?php

namespace App\Providers;

use App\Ladder;
use Config;
use Illuminate\Support\ServiceProvider;
use johnleider\BattleNet\Diablo;
use Menu;

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
