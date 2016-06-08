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

    /**
     * @param $q
     * @return mixed
     */
    public function scopeHighestRift($q)
    {
        return $q->select('leaderboards.*')
            ->join('hero_leaderboard', 'hero_leaderboard.leaderboard_id', '=', 'leaderboards.id')
            ->join('heroes', 'heroes.id', '=', 'hero_leaderboard.hero_id')
            ->orderBy('rift_level', 'desc')
            ->orderBy('rift_time', 'asc');
    }

    /**
     * @param $q
     * @return mixed
     */
    public function scopeHighestRiftSolo($q)
    {
        return $q->highestRift()
            ->groupBy('hero_leaderboard.leaderboard_id');
    }

    /**
     * @param $q
     * @return mixed
     */
    public function scopeHighestRiftTeam($q)
    {
        return $q->highestRift()
            ->groupBy('hero_leaderboard.leaderboard_id');
    }

    /**
     * @param $q
     * @param $hardcore
     * @return mixed
     */
    public function scopeHardcore($q, $hardcore)
    {
        return $q->where('leaderboards.hardcore', '=', $hardcore);
    }
}
