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
                ->with(['hero', 'profile'])
                ->limit(20)
                ->get();

            $query->all()[0]['show'] = true;

            $data->put($type, $query);

        }

        return $data->toJson();
    }
}
