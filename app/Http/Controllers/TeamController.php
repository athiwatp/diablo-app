<?php

namespace App\Http\Controllers;

use App\Diablo\Rankings;
use App\Ladder;
use Diablo;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param $mode
     * @param $period
     * @param $players
     * @return \Illuminate\Http\Response
     */
    public function index($mode, $period, $players)
    {
        $rankings = Ladder::teams($players)
            ->mode($mode)
            ->period($period)
            ->with(['hero' => function ($q) {
                $q->with('profile');
            }])->paginate(25);

        $type = 'teams';
        $playerOptions = [4, 3, 2];

        return view('ladders.index', compact('rankings', 'mode', 'period', 'type', 'players', 'playerOptions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $mode
     * @param $period
     * @param $players
     * @return \Illuminate\Http\Response
     */
    public function update($mode, $period, $players)
    {
        $teams = Diablo::$mode($period)
            ->team($players);

        $rankings = new Rankings();

        $rankings->parse($teams);

        return redirect()
            ->back();
    }
}
