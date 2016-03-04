<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Leaderboard;
use Cache;
use Diablo;
use Illuminate\Database\Eloquent\Collection;
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
    public function class(Request $request, $season, $class) : View
    {
        $data = new Collection;
        $data->put('softcore', $this->dataSoftcore($season, $class));
        $data->put('hardcore', $this->dataHardcore($season, $class));

        return view('leaderboards.class', compact('data'));
    }

    public function dataSoftcore($season, $class)
    {
        return Leaderboard::season()
            ->softcore()
            ->period($season)
            ->solo()
            ->$class()
            ->orderBy('rift_level', 'desc')
            ->orderBy('rift_time', 'asc')
            ->with(['hero', 'profile'])
            ->paginate(20);
    }

    public function dataHardcore($season, $class)
    {
        return Leaderboard::season()
            ->hardcore()
            ->period($season)
            ->solo()
            ->$class()
            ->orderBy('rift_level', 'desc')
            ->orderBy('rift_time', 'asc')
            ->with(['hero', 'profile'])
            ->paginate(20);
    }

    public function search()
    {
//        if ($request->has('searchText')) {
//            $query->join('profiles', function ($join) use ($request) {
//                $join->on('profiles.id', '=', 'leaderboards.profile_id')
//                    ->where('battle_tag', 'like', '%'.$request->get('searchText').'%');
//            });
//        }
    }
}