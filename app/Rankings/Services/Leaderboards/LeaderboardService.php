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

            $hero_record = Hero::firstOrNew([
                'battlenet_hero_id' => $hero->battlenet_hero_id,
                'profile_id' => $profile->id
            ]);

            if (!empty($hero->class)) {
                $hero = array_except((array)$hero, ['class']);
            }

            $hero_record->fill((array) $hero);
            $hero_record->save();

            $hero_array[$hero_record->id] = [
                'profile_id' => $profile->id
            ];
        }

        $leaderboard = Leaderboard::firstOrCreate([
            'season' => $data['data']['season'],
            'period' => $data['data']['period'],
            'players' => $data['data']['players'],
            'rift_level' => $data['data']['rift_level'],
            'rift_timestamp' => $data['data']['completed_time'],
            'rift_time' => $data['data']['rift_time']
        ]);


        if (!empty($leaderboard->region)) {
            $data['data'] = array_except($data['data'], ['region']);
        }

        $leaderboard->fill($data['data']);
        $leaderboard->save();

        $leaderboard->heroes()
            ->sync($hero_array);
    }
}