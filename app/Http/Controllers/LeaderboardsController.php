<?php

namespace App\Http\Controllers;

use App\Filters\LeaderboardFilter;
use App\Http\Requests;
use App\Leaderboard;
use Cache;
use DB;
use Diablo;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\View;
use Response;

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
    public function index() : \Illuminate\View\View
    {
        return View::make('leaderboards.index');
    }

    /**
     * @param Leaderboard $leaderboard
     * @return mixed
     */
    public function show(Leaderboard $leaderboard) : \Illuminate\View\View
    {
        $leaderboard->load(['heroes', 'profiles']);

        $data = $leaderboard;

        return View::make('leaderboards.show', compact('data'));
    }

    /**
     * @param Leaderboard $leaderboard
     * @return Collection
     */
    public function preview(LeaderboardFilter $filters) : \Illuminate\View\View
    {
        $leaderboard = Leaderboard::filter($filters)
            ->with(['heroes', 'profiles']);

        $data = new Collection;

        foreach (['softcore', 'hardcore'] as $type) {
            $query = clone $leaderboard;

            $data->put($type,
                $query->limit(25)
                    ->get()
            );
        }

        $data->put('softcore_show_all', "/leaderboards/filter/paginate?hardcore=0&" . $filters->request->getQueryString());
        $data->put('hardcore_show_all', "/leaderboards/filter/paginate?hardcore=1&" . $filters->request->getQueryString());

        return View::make('leaderboards.filter', compact('data'));
    }

    /**
     * @param Leaderboard $leaderboard
     * @return mixed
     */
    public function paginate(LeaderboardFilter $filters) : \Illuminate\View\View
    {
        $data = Leaderboard::filter($filters)
            ->with(['heroes', 'profiles'])
            ->paginate(25);

        parse_str($filters->request->getQueryString(), $appends);

        $data->appends($appends);

        $data = $data->toJson();

        return View::make('leaderboards.filter', compact('data'));
    }
}