<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leaderboard extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'profile_id',
        'hero_id',
        'season',
        'period',
        'players',
        'rift_level',
        'rift_time',
        'hardcore',
        'rank',
        'class',
        'region'
    ];

    /**
     * The model casts
     * 
     * @var array
     */
    protected $casts = [
        'season' => 'boolean'
    ];

    /**
     * A Leaderboard belongs to a Hero
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function hero()
    {
        return $this->belongsTo(Hero::class, 'hero_id');
    }

    /**
     * A Leaderboard belongs to a Profile
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function profile()
    {
        return $this->belongsTo(Profile::class);
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
            ->where('leaderboards.class', '=', 'barbarian')
            ->ladder();
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
            ->where('heroes.class', '=', 'crusader')
            ->ladder();
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
            ->where('heroes.class', '=', 'demon hunter')
            ->ladder();
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
            ->where('heroes.class', '=', 'monk')
            ->ladder();
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
            ->where('heroes.class', '=', 'witch doctor')
            ->ladder();
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
            ->where('heroes.class', '=', 'wizard')
            ->ladder();
    }

    /**
     * Shorthand for 2 player teams
     *
     * @param $q
     * @return mixed
     */
    public function scope2Player($q)
    {
        return $q->teams(2);
    }

    /**
     * Shorthand for 3 player teams
     * @param $q
     * @return mixed
     */
    public function scope3Player($q)
    {
        return $q->teams(3);
    }

    /**
     * Shorthand for 4 player teams
     *
     * @param $q
     * @return mixed
     */
    public function scope4Player($q)
    {
        return $q->teams(4);
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
        return $q->where('leaderboards.players', $players)
            ->ladder();
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
            ->join('heroes', 'heroes.id', '=', 'leaderboards.hero_id');
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
        return $q->where('leaderboards.players', 1);
    }
}
