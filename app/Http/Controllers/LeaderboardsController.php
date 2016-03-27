<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Leaderboard;
use App\Rankings\Parsers\Leaderboards\LeaderboardParser;
use Cache;
use DB;
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
     * @param Leaderboard $leaderboard
     * @return mixed
     */
    public function show(Leaderboard $leaderboard)
    {
        $leaderboard->load(['heroes', 'profiles']);

        $data = $leaderboard;

        return View::make('leaderboards.show', compact('data'));
    }

    /**
     * @param Request $request
     * @return Collection
     */
    public function filter(Request $request)
    {
        $leaderboard = new Leaderboard;

        if ($request->has('players')) {
            $leaderboard = $leaderboard->where('players', '=', $request->get('players'));
        } else {
            $leaderboard = $leaderboard->where('players', '=', 1);
        }

        if ($request->has('class')) {
            $leaderboard = $leaderboard->whereIn('heroes.class', $request->get('class'));
        }

        if ($request->has('region')) {
            $leaderboard = $leaderboard->whereIn('leaderboards.region', $request->get('region'));
        }

        $leaderboard = $leaderboard->where('leaderboards.season', '=', $request->get('season'))
            ->where('period', '=', $request->get('period'))
            ->highestRift()
            ->with(['heroes', 'profiles']);

        $data = $request->has('hardcore')
            ? $this->filterPaginate($leaderboard, $request->get('hardcore'), $request->getQueryString())
            : $this->filterPreview($leaderboard, $request->getQueryString());

        return View::make('leaderboards.filter', compact('data'));
    }

    /**
     * @param Leaderboard $leaderboard
     * @return Collection
     */
    public function filterPreview($leaderboard, $query_string)
    {
        $data = new Collection;

        foreach (['softcore', 'hardcore'] as $type) {
            $query = clone $leaderboard;

            $data->put($type,
                $query->hardcore($type)
                    ->limit(25)
                    ->get()
            );
        }

        $data->put('softcore_show_all', "/leaderboards/filter?hardcore=0&{$query_string}");
        $data->put('hardcore_show_all', "/leaderboards/filter?hardcore=1&{$query_string}");

        return $data;
    }

    /**
     * @param Leaderboard $leaderboard
     * @return mixed
     */
    public function filterPaginate($leaderboard, $type, $query_string)
    {
        $data = $leaderboard->where('leaderboards.hardcore', '=', $type)
            ->paginate(25);

        parse_str($query_string, $appends);

        $data->appends($appends);

        return $data->toJson();
    }
}