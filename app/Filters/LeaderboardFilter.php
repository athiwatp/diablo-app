<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class LeaderboardFilter extends QueryFilter
{
    /**
     * @param int $players
     * @return mixed
     */
    public function players(int $players = 1) : Builder
    {
        $this->builder->where('players', '=', $players);

        if ($players === 1) {
            return $this->builder->highestRiftSolo();
        }

        return $this->builder->highestRiftTeam();
    }

    /**
     * @param $classes
     * @return mixed
     */
    public function class(array $classes) : Builder
    {
        return $this->builder->whereIn('heroes.class', $classes);
    }

    /**
     * @param $regions
     * @return mixed
     */
    public function region(array $regions) : Builder
    {
        return $this->builder->whereIn('leaderboards.region', $regions);
    }

    /**
     * @param $season
     * @return mixed
     */
    public function season(int $season) : Builder
    {
        return $this->builder->where('leaderboards.season', '=', $season);
    }

    /**
     * @param $period
     * @return mixed
     */
    public function period(int $period) : Builder
    {
        return $this->builder->where('leaderboards.period', '=', $period);
    }

    /**
     * @param int $hardcore
     * @return mixed
     */
    public function hardcore(int $hardcore = 0) : Builder
    {
        return $this->builder->where('leaderboards.hardcore', '=', $hardcore);
    }
}