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
     * A Leaderboard belongs to a Hero
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function hero()
    {
        return $this->belongsTo(Hero::class, 'hero_id');
    }

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
    public function scopeBarbarians($q)
    {
        return $q->solo()
            ->where('leaderboards.hero_class', '=', 'barbarian')
            ->ladder();
    }

    /**
     * Solo crusader scope
     *
     * @param $q
     * @return mixed
     */
    public function scopeCrusaders($q)
    {
        return $q->solo()
            ->where('heroes.hero_class', '=', 'crusader')
            ->ladder();
    }

    /**
     * Solo demonhunters scope
     *
     * @param $q
     * @return mixed
     */
    public function scopeDemonHunters($q)
    {
        return $q->solo()
            ->where('heroes.hero_class', '=', 'demon hunter')
            ->ladder();
    }

    /**
     * Solo monks scope
     *
     * @param $q
     * @return mixed
     */
    public function scopeMonks($q)
    {
        return $q->solo()
            ->where('heroes.hero_class', '=', 'monk')
            ->ladder();
    }

    /**
     * Solo witchdoctors scope
     *
     * @param $q
     * @return mixed
     */
    public function scopeWitchDoctors($q)
    {
        return $q->solo()
            ->where('heroes.hero_class', '=', 'witch doctor')
            ->ladder();
    }

    /**
     * Solo wizards scope
     *
     * @param $q
     * @return mixed
     */
    public function scopeWizards($q)
    {
        return $q->solo()
            ->join('heroes', 'heroes.id', '=', 'leaderboards.hero_id')
            ->where('heroes.hero_class', '=', 'wizard')
            ->ladder();
    }

    /**
     * Teams scope
     *
     * @param $q
     * @param $players
     * @return mixed
     */
    public function scopeTeams($q, $players)
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
        return $q->select('leaderboards.id', 'leaderboards.profile_id', 'leaderboards.hero_id as hero_id', 'leaderboards.rank', 'leaderboards.mode', 'leaderboards.period', 'leaderboards.players', 'leaderboards.rift_level', 'leaderboards.rift_time', 'leaderboards.created_at', 'leaderboards.updated_at')
            ->join('heroes', 'heroes.id', '=', 'leaderboards.hero_id')
            ->orderBy('leaderboards.rank');
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

    public function scopeSolo($q)
    {
        return $q->where('leaderboards.players', 1);
    }
}
