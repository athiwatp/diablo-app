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
        return $q->groupBy('hero_leaderboard.hero_id')
            ->select(DB::raw('leaderboards.*, max(leaderboards.rift_level) as rift_level'));
    }

    /**
     * Solo barbarian scope
     *
     * @param $q
     * @return mixed
     */
    public function scopeBarbarian($q)
    {
        return $q->solo()
            ->where('heroes.class', '=', 'barbarian');
    }

    /**
     * Solo crusader scope
     *
     * @param $q
     * @return mixed
     */
    public function scopeCrusader($q)
    {
        return $q->solo()
            ->where('heroes.class', '=', 'crusader');
    }

    /**
     * Solo demonhunters scope
     *
     * @param $q
     * @return mixed
     */
    public function scopeDemonHunter($q)
    {
        return $q->solo()
            ->where('heroes.class', '=', 'demon-hunter');
    }

    /**
     * Solo monks scope
     *
     * @param $q
     * @return mixed
     */
    public function scopeMonk($q)
    {
        return $q->solo()
            ->where('heroes.class', '=', 'monk');
    }

    /**
     * Solo witchdoctors scope
     *
     * @param $q
     * @return mixed
     */
    public function scopeWitchDoctor($q)
    {
        return $q->solo()
            ->where('heroes.class', '=', 'witch-doctor');
    }

    /**
     * Solo wizards scope
     *
     * @param $q
     * @return mixed
     */
    public function scopeWizard($q)
    {
        return $q->solo()
            ->where('heroes.class', '=', 'wizard');
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
     * Ladder scope
     *
     * @param $q
     * @return mixed
     */
    public function scopeLadder($q)
    {
        return $q->select('leaderboards.*')
            ->join('hero_leaderboard', 'leaderboards.id', '=', 'hero_leaderboard.leaderboard_id')
            ->join('heroes', 'hero_leaderboard.hero_id', '=', 'heroes.id')
            ->orderBy('rift_level', 'desc')
            ->orderBy('rift_time', 'asc');
    }

    /**
     * Season scope
     *
     * @param $q
     * @return mixed
     */
    public function scopeSeason($q)
    {
        return $q->where('leaderboards.season', true);
    }

    /**
     * Era scope
     *
     * @param $q
     * @return mixed
     */
    public function scopeEra($q)
    {
        return $q->where('leaderboards.season', false);
    }

    /**
     * Period scope
     * {Season\Era}
     *
     * @param $q
     * @param $period
     * @return mixed
     */
    public function scopePeriod($q, $period)
    {
        return $q->where('leaderboards.period', $period);
    }

    /**
     * Hardcore scope
     *
     * @param $q
     * @return mixed
     */
    public function scopeHardcore($q)
    {
        return $q->where('leaderboards.hardcore', true);
    }

    /**
     * Softcore scope
     *
     * @param $q
     * @return mixed
     */
    public function scopeSoftcore($q)
    {
        return $q->where('leaderboards.hardcore', false);
    }

    /**
     * Solo scope
     *
     * @param $q
     * @return mixed
     */
    public function scopeSolo($q)
    {
        return $q->where('leaderboards.players', 1)
            ->ladder();
    }
}
