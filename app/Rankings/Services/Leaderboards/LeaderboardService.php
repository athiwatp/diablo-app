<?php

namespace App\Rankings\Services\Leaderboards;

use App\{
    Leaderboard, Profile, ProfileStat, Hero
};

class LeaderboardService
{
    /**
     * Persist the Leaderboard record with corresponding
     * Hero and Profile records
     *
     * @param $record
     */
    public function save($record)
    {
        $profile = Profile::firstOrNew([
            'battle_tag' => $record->battle_tag
        ]);

        if (!$profile->exists) {
            $profile->region = $record->region;
            $profile->save();
        }

        $hero = Hero::updateOrCreate([
            'battlenet_hero_id' => $record->battlenet_hero_id,
            'profile_id' => $profile->id
        ], (array)$record);

        Leaderboard::updateOrCreate([
            'profile_id' => $profile->id,
            'hero_id' => $hero->id,
            'season' => $record->season,
            'period' => $record->period,
            'players' => $record->players
        ], (array)$record);
    }
}