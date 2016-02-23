<?php

namespace App\Diablo\Services\Leaderboards;

use App\{Leaderboard, Profile, ProfileStat, Hero};
use Illuminate\Foundation\Bus\DispatchesJobs;

class LeaderboardService
{
    use DispatchesJobs;

    /**
     * Persist the Leaderboard record with corresponding
     * Hero and Profile records
     *
     * @param $record
     */
    public function save($record)
    {
        $profile = Profile::firstOrNew([
            'battle_tag' => $record['battle_tag']
        ]);

        if (! $profile->exists) {
            $profile->region = $record['region'];
            $profile->save();
        }

        ProfileStat::updateOrCreate([
            'profile_id' => $profile->id
        ]);

        $hero = Hero::updateOrCreate([
            'battlenet_hero_id' => $record['battlenet_hero_id'],
            'profile_id' => $profile->id
        ], $record);

        Leaderboard::updateOrCreate([
            'profile_id' => $profile->id,
            'hero_id' => $hero->id,
            'season' => $record['season'],
            'period' => $record['period'],
            'players' => $record['players']
        ], $record);
    }
}