<?php

namespace App\Http\Controllers;

use App\Diablo\Rankings;
use App\Ladder;
use Diablo;
use Illuminate\Http\Request;
use App\Http\Requests;

class LadderController extends Controller
{
    public function index($type, $mode, $period, $rift_type, $region, $players = null)
    {
        $rankings = Ladder::$type($players)
            ->mode($mode)
            ->period($period)
            ->with(['hero' => function ($q) {
                $q->with('profile');
            }])->paginate(25);

        $playerOptions = [4, 3, 2];

        return view('ladders.index', compact(
            'rankings', 'mode', 'period', 'type', 'rift_type', 'region', 'players', 'playerOptions'
        ));
    }

    public function update($type, $mode, $period, $rift_type, $region, $players = null)
    {
        $response = Diablo::$mode($period)
            ->$type($players);

        $rankings = new Rankings();

        $rankings->parse($response);

        return redirect()
            ->back();
    }
}
