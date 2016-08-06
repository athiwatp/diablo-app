<?php

namespace App\Http\Controllers;

use App\Leaderboard;
use Cache;
use Illuminate\Support\Collection;
use View;

class HomeController extends Controller
{

    /**
     * Home Index
     *
     * @return string
     */
    public function index() : string
    {
        if (env('APP_ENV') === 'local') {
            return View::make('home.index')->withData($this->data());
        }

        return Cache::remember('home-view', 60, function () {
            $data = $this->data();

            return View::make('home.index', compact('data'))->render();
        });
    }

    /**
     * Home view data
     *
     * @param Collection $data
     * @return string
     */
    public function data() : string
    {
        $data = new Collection;

        foreach (['softcore', 'hardcore'] as $index => $type) {
            $query = Leaderboard::where('leaderboards.season', '=', 1)
                ->where('leaderboards.hardcore', '=', $index)
                ->where('leaderboards.period', '=', env('CURRENT_SEASON'))
                ->where('leaderboards.players', '=', 1)
                ->highestRiftSolo()
                ->with(['heroes', 'profiles'])
                ->limit(25)
                ->get();

            $data->put($type, $query);
        }

        $data->put('softcore_show_all', '/leaderboards/filter/paginate?season=1&period=7&hardcore=0&players=1');
        $data->put('hardcore_show_all', '/leaderboards/filter/paginate?season=1&period=7&hardcore=1&players=1');

        return $data->toJson();
    }
}
