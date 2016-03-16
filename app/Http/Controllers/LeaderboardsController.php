<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Leaderboard;
use App\Rankings\Parsers\Leaderboards\LeaderboardParser;
use Cache;
use Diablo;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\View;
use Response;
use Illuminate\Http\Request;

/**
 * This controller is redundant for a reason
 * if the need to have different functionality within each specific
 * section changes, it will be nice to have the abstraction now
 *
 * Class LeaderboardsController
 * @package App\Http\Controllers
 */
class LeaderboardsController extends Controller
{
    /**
     * @return mixed
     */
    public function index()
    {
        return View::make('leaderboards.index');
    }

    /**
     * @param Request $request
     * @param $mode
     * @param $period
     * @param $type
     * @return mixed
     */
    public function seasonShow(Request $request, $mode, $period, $type)
    {
        $data = Leaderboard::$mode()
            ->$type()
            ->period($period)
            ->solo()
            ->orderBy('rift_level', 'desc')
            ->orderBy('rift_time', 'asc')
            ->with(['hero', 'profile'])
            ->paginate(25)
            ->toJson();

        return View::make('leaderboards.season-show', compact('data'));
    }

    /**
     * @param Request $request
     * @param $mode
     * @param $period
     * @param $class
     * @return mixed
     */
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

    /**
     * @param Request $request
     * @param $mode
     * @param $period
     * @param $players
     * @return mixed
     */
    public function teamIndex(Request $request, $mode, $period, $players)
    {
        $data = new Collection;
        $leaderboard_parser = new LeaderboardParser;

        // Abstract this
        foreach (['softcore', 'hardcore'] as $type) {
            $query = Leaderboard::$mode()
                ->$type()
                ->period($period)
                ->team($players)
                ->orderBy('rift_level', 'desc')
                ->orderBy('rift_time', 'asc')
                ->orderBy('class', 'asc')
                ->with('hero')
                ->limit(25 * $players)
                ->get();

            $data->put($type, $leaderboard_parser->groupTeams($query, $players));
        }
        
        $data->put('softcore_show_all', '/'.$request->path().'/softcore');
        $data->put('hardcore_show_all', '/'.$request->path().'/hardcore');

        return View::make('leaderboards.team-index', compact('data'));
    }

    /**
     * @param Request $request
     * @param $mode
     * @param $period
     * @param $class
     * @param $type
     * @return \Illuminate\View\View
     */
    public function classShow(Request $request, $mode, $period, $class, $type) : \Illuminate\View\View
    {
        $query = Leaderboard::$mode()
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

    /**
     * @param Request $request
     * @param $mode
     * @param $period
     * @param $players
     * @param $type
     * @return \Illuminate\View\View
     */
    public function teamShow(Request $request, $mode, $period, $players, $type) : \Illuminate\View\View
    {
        $leaderboard_parser = new LeaderboardParser;

        $data = Leaderboard::$mode()
            ->$type()
            ->period($period)
            ->team($players)
            ->orderBy('rift_level', 'desc')
            ->orderBy('rift_time', 'asc')
            ->orderBy('class', 'asc')
            ->with('hero')
            ->paginate(25 * $players);

        $page = $request->get('page') ?? 1;
        $parsed = $leaderboard_parser->groupTeams(
            $data,
            $players,
            1 + (($page - 1) * 25)
        );

        $data = $data->toArray();
        $data['parsed'] = $parsed;
        $data = json_encode($data);

        return View::make('leaderboards.team-show', compact('data'));
    }
}