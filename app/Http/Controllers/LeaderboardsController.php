<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Leaderboard;
use Cache;
use Diablo;
use Response;
use Illuminate\View\View;
use Illuminate\Http\Request;

class LeaderboardsController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param null $type
     * @return \Illuminate\Contracts\View\Factory|View
     */
    public function index($type = null) : View
    {
        return view('leaderboards.index', compact('type'));
    }

    /**
     * API Return
     *
     * @param Request $request
     * @param $type
     */
    public function data(Request $request, $type)
    {
        if (is_null($type)) {
            return;
        }

        $query = Leaderboard::with(['profile', 'hero'])
            ->$type()
            ->season()
            ->softcore()
            ->period(5)
            ->orderBy('leaderboards.rift_level', 'desc');

        if ($request->has('searchText')) {
            $query->join('profiles', function ($join) use ($request) {
                $join->on('profiles.id', '=', 'leaderboards.profile_id')
                    ->where('battle_tag', 'like', '%'.$request->get('searchText').'%');
            });
        }

        return $query->paginate(25);
    }
}