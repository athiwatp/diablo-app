<?php

namespace App;

use App\Rankings\Services\Profile\ProfileService;
use App\Traits\Queueable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use Queueable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'battle_tag', 'region'
    ];

    /**
     * The attributes that are dates
     * 
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'queued_at'
    ];

    /**
     * @var array
     */
    protected $appends = [
        'queueable',
        'available_in'
    ];

    /**
     * @param $value
     * @return string
     */
    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }

    /**
     * Access Hero API
     *
     * @return Heroes
     */
    public function api()
    {
        return (new ProfileService())->profile($this);
    }

    /**
     * A Profile has many Rift Rankings
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function seasonRankings()
    {
        return $this->belongsToMany(Leaderboard::class, 'hero_leaderboard')
            ->where('season', '=', true)
            ->where('period', '=', 5)
            ->orderBy('players', 'asc')
            ->orderBy('rift_level', 'desc')
            ->orderBy('rift_timestamp', 'desc');
    }

    /**
     * A Profile has many Heroes
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function heroes()
    {
        return $this->hasMany(Hero::class)
            ->orderBy('season', 'desc')
            ->orderBy('name');
    }

    /**
     * A Profile has many Leaderboards
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function leaderboards()
    {
        return $this->hasMany(Leaderboard::class);
    }

    public function availability()
    {
        return true;
    }

    /**
     * A Profile has one stats
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function stats()
    {
        return $this->hasOne(ProfileStat::class);
    }
}
