<?php

namespace App;

use App\Diablo\Services\Profile\ProfileService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'battle_tag', 'region'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'queued_at'
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
     * @return bool
     */
    public function setQueuable()
    {
        if (is_null($this->queued_at)) {
            $this->queuable = true;
        } else {
            $this->queuable = Carbon::now()->addHours(12)->lte($this->queued_at);
        }

    }

    public function setAvailableIn()
    {
        if (is_null($this->queued_at)) {
            $this->available_in = null;
        } else {
            $this->available_in = $this->queued_at->addHours(12)->diffForHumans();
        }

    }

    /**
     * Access Hero API
     *
     * @return Heroes
     */
    public function api()
    {
        return new ProfileService($this);
    }

    /**
     * A Profile has many Rift Rankings
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function riftRankings()
    {
        return $this->hasMany(Leaderboard::class)
            ->where('season', '=', true)
            ->groupBy('period')
            ->orderBy('rift_level', 'desc');
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

    public function stats()
    {
        return $this->hasOne(ProfileStat::class);
    }
}
