<?php

namespace App\Diablo\Services\Leaderboards;

use Illuminate\Foundation\Bus\DispatchesJobs;
use App\Http\Controllers\HeroController;
use App\Jobs\UpdateHero;
use App\{Leaderboard, Profile, Hero};

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
        $profile = Profile::firstOrCreate([
            'battle_tag' => $record['battle_tag'],
            'region' => $record['region']
        ]);

        $hero = Hero::updateOrCreate([
            'battlenet_hero_id' => $record['battlenet_hero_id'],
            'profile_id' => $profile->id
        ], $record);

        $this->dispatch(new UpdateHero($hero));

        Leaderboard::updateOrCreate([
            'profile_id' => $profile->id,
            'hero_id' => $hero->id,
            'season' => $record['season'],
            'period' => $record['period'],
            'players' => $record['players']
        ], $record);
    }
}