<?php

namespace App\Http\Controllers;

use App\Leaderboard;
use Cache;
use DB;
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
        Cache::forget('home-view');
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
        foreach (['softcore', 'hardcore'] as $type) {
            $query = Leaderboard::season()
                ->$type()
                ->period(5)
                ->solo()
                ->orderBy('rift_level', 'desc')
                ->orderBy('rift_time', 'asc')
                ->ladder()
                ->with(['heroes', 'profiles'])
                ->limit(25)
                ->select('leaderboards.*', DB::raw('FALSE as `show`'))
                ->get();

            $query->all()[0]['show'] = true;

            $data->put($type, $query);
        }

        $data->put('softcore_show_all', '/leaderboards/season/' . env('CURRENT_SEASON') . '/softcore');
        $data->put('hardcore_show_all', '/leaderboards/season/' . env('CURRENT_SEASON') . '/hardcore');

        return $data->toJson();
    }
}
