<?php

namespace App;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Leaderboard extends Model
{
    use Filterable;

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
                DB::raw('(select hero_leaderboard.leaderboard_id, hero_leaderboard.hero_id from heroes join hero_leaderboard on hero_leaderboard.hero_id = heroes.id order by hero_leaderboard.leaderboard_id desc) hl'), function ($join) {
                $join->on('hl.leaderboard_id', '=', 'l2.id');
            }
            )
            ->join('heroes', 'heroes.id', '=', 'hl.hero_id')
            ->orderBy('rift_level', 'desc')
            ->orderBy('rift_time', 'asc');
    }

    public function scopeHighestRiftSolo($q)
    {
        return $q->highestRift()
            ->groupBy('hl.hero_id');
    }

    public function scopeHighestRiftTeam($q)
    {
        return $q->highestRift()
            ->groupBy('hl.leaderboard_id');
    }
}
