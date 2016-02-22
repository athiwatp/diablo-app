<?php

namespace App;

use App\Diablo\Services\Profile\ProfileService;
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
        return $this->hasMany(Hero::class);
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
