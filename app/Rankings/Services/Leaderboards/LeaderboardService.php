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
    public function save($data)
    {
        $hero_array = [];

        foreach ($data['players'] as $hero) {
            $profile = Profile::firstOrNew([
                'battle_tag' => $hero->battle_tag
            ]);

            if (!$profile->exists) {
                $profile->region = $hero->region;
                $profile->save();
            }

            if (!isset($hero->battlenet_hero_id)) {
                continue;
            }

            $hero = Hero::updateOrCreate([
                'battlenet_hero_id' => $hero->battlenet_hero_id,
                'profile_id' => $profile->id
            ], (array)$hero);

            $hero_array[$hero->id] = [
                'profile_id' => $profile->id
            ];
        }

        $leaderboard = Leaderboard::firstOrCreate([
            'season' => $data['data']['season'],
            'period' => $data['data']['period'],
            'players' => $data['data']['players'],
            'rift_level' => $data['data']['rift_level'],
            'region' => $data['data']['region'],
            'rift_timestamp' => $data['data']['completed_time'],
            'rift_time' => $data['data']['rift_time']
        ]);

        $leaderboard->fill($data['data']);
        $leaderboard->save();

        $leaderboard->heroes()
            ->sync($hero_array);
    }
}