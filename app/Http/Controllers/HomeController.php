<?php

namespace App\Http\Controllers;

use App\Diablo\Rankings;
use App\Leaderboard;
use App\Http\Requests;
use Cache;
use Illuminate\Database\Eloquent\Collection;

class HomeController extends Controller
{

    /**
     * Home Index
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return Cache::remember('homePage', 60, function () {
            return view('home.index')->render();
        });
    }

    /**
     * Home view data
     *
     * @param Collection $ladders
     * @return string
     */
    public function data(Collection $ladders)
    {
        $query = Leaderboard::season()
            ->period(5)
            ->solo()
            ->orderBy('rift_level', 'desc')
            ->orderBy('rift_time', 'asc')
            ->with(['hero', 'profile'])
            ->limit(10)
            ->get();

        $ladders->put('softcore',
            [
                'top' => $query->shift(),
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

        $ladders->put('hardcore',
            [
                'top' => $query->shift(),
                'ladder' => $query
            ]
        );

        return $ladders->toJson();
    }
}
