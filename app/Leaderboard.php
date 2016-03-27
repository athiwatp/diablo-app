<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Leaderboard extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'season',
        'period',
        'players',
        'rift_level',
        'rift_time',
        'rift_timestamp',
        'hardcore',
        'rank',
        'region'
    ];

    /**
     * The model casts
     * 
     * @var array
     */
    protected $casts = [
        'season' => 'boolean',
        'hardcore' => 'boolean'
    ];

    /**
     * A Leaderboard belongs to a Hero
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function heroes()
    {
        return $this->belongsToMany(Hero::class);
    }

    /**
     * A Leaderboard belongs to a Profile
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function profiles()
    {
        return $this->belongsToMany(Profile::class, 'hero_leaderboard');
    }

    public function scopeHighestRift($q)
    {
        return $q->select('leaderboards.*')
            ->join(
                DB::raw('(select id, max(rift_level) max_rift from leaderboards group by id) l2'), function ($join) {
                $join->on('l2.max_rift', '=', 'leaderboards.rift_level')
                    ->on('l2.id', '=', 'leaderboards.id');
            }
            )
            ->join(
                DB::raw('(select max(leaderboard_id) as leaderboard_id, hero_id from hero_leaderboard group by hero_id) hl'), function ($join) {
                $join->on('hl.leaderboard_id', '=', 'l2.id');
            }
            )
            ->join('heroes', 'heroes.id', '=', 'hl.hero_id')
            ->groupBy('leaderboards.id')
            ->orderBy('rift_level', 'desc')
            ->orderBy('rift_time', 'asc');
    }

    /**
     * Teams scope
     *
     * @param $q
     * @param $players
     * @return mixed
     */
    public function scopeTeam($q, $players)
    {
        return $q->where('leaderboards.players', $players);
    }

    /**
     * Season scope
     *
     * @param $q
     * @return mixed
     */
    public function scopeSeason($q, $season)
    {
        return $q->where('leaderboards.season', $season);
    }

    /**
     * @param $q
     * @param $hardcore
     * @return mixed
     */
    public function scopeHardcore($q, $hardcore)
    {
        if (is_string($hardcore)) {
            $hardcore = $hardcore == 'softcore'
                ? 0
                : 1;
        }

        return $q->where('leaderboards.hardcore', $hardcore);
    }

    /**
     * Period scope
     * {Season\Era}
     *
     * @param $q
     * @param $period
     * @return mixed
     */
    public function scopePeriod($q, $periods)
    {
        return $q->whereIn('leaderboards.period', $periods);
    }

    /**
     * Solo scope
     *
     * @param $q
     * @return mixed
     */
    public function scopeSolo($q)
    {
        return $q->where('leaderboards.players', 1);
    }
}
