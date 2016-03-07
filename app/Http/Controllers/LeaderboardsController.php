<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Leaderboard;
use Cache;
use Diablo;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\View;
use Response;
use Illuminate\Http\Request;

class LeaderboardsController extends Controller
{
    public function index()
    {
        return View::make('leaderboards.index');
    }

    public function classIndex(Request $request, $mode, $period, $class)
    {
        $data = new Collection;

        foreach (['softcore', 'hardcore'] as $type) {
            $data->put($type,
                Leaderboard::$mode()
                    ->$type()
                    ->period($period)
                    ->$class()
                    ->orderBy('rift_level', 'desc')
                    ->orderBy('rift_time', 'asc')
                    ->with(['hero', 'profile'])
                    ->limit(25)
                    ->get()
            );
        }
        
        $data->put('softcore_show_all', '/'.$request->path().'/softcore');
        $data->put('hardcore_show_all', '/'.$request->path().'/hardcore');

        return View::make('leaderboards.class-index', compact('data'));
    }

    public function teamIndex(Request $request, $mode, $period, $players)
    {
        $data = new Collection;

        foreach (['softcore', 'hardcore'] as $type) {
            $data->put($type,
                Leaderboard::$mode()
                    ->$type()
                    ->period($period)
                    ->team($players)
                    ->orderBy('rift_level', 'desc')
                    ->orderBy('rift_time', 'asc')
                    ->with(['hero', 'profile'])
                    ->limit(25)
                    ->get()
            );
        }
        
        $data->put('softcore_show_all', '/'.$request->path().'/softcore');
        $data->put('hardcore_show_all', '/'.$request->path().'/hardcore');

        return View::make('leaderboards.team-index', compact('data'));
    }

    public function classShow(Request $request, $mode, $period, $class, $type) : \Illuminate\View\View
    {
        $data = Leaderboard::$mode()
            ->$type()
            ->period($period)
            ->solo()
            ->$class()
            ->orderBy('rift_level', 'desc')
            ->orderBy('rift_time', 'asc')
            ->with(['hero', 'profile'])
            ->paginate(20)
            ->toJson();

        return View::make('leaderboards.class-show', compact('data'));
    }

    public function teamShow(Request $request, $mode, $period, $players, $type) : \Illuminate\View\View
    {
        $data = Leaderboard::$mode()
            ->$type()
            ->period($period)
            ->team($players)
            ->orderBy('rift_level', 'desc')
            ->orderBy('rift_time', 'asc')
            ->with(['hero', 'profile'])
            ->paginate(20)
            ->toJson();

        return View::make('leaderboards.team-show', compact('data'));
    }
}