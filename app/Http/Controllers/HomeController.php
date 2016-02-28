<?php

namespace App\Http\Controllers;

use App\Diablo\Rankings;
use App\Leaderboard;
use Cache;
use Illuminate\Support\Collection;
use View;

class HomeController extends Controller
{

    /**
     * Home Index
     *
     * @return \Illuminate\View\View
     */
    public function index() : \Illuminate\View\View
    {
        Cache::forget('home-page');
        $data = Cache::remember('home-page', 60, function () {
            return $this->data();
        });

        return View::make('home.index', compact('data'));
    }

    /**
     * Home view data
     *
     * @param Collection $ladders
     * @return string
     */
    public function data() : string
    {
        $ladders = new Collection;
        $query = Leaderboard::season()
            ->period(5)
            ->solo()
            ->orderBy('rift_level', 'desc')
            ->orderBy('rift_time', 'asc')
            ->with(['hero', 'profile'])
            ->limit(10)
            ->get();

        $query->all()[0]['show'] = true;

        $ladders->put('softcore',
            [
                'ladder' => $query
            ]
        );

        $query = Leaderboard::season()
            ->hardcore()
            ->period(5)
            ->solo()
            ->orderBy('rift_level', 'desc')
            ->orderBy('rift_time', 'asc')
            ->with(['hero', 'profile'])
            ->limit(10)
            ->get();

        $query->all()[0]['show'] = true;

        $ladders->put('hardcore',
            [
                'ladder' => $query
            ]
        );

        return $ladders->toJson();
    }
}
