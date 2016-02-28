<?php

namespace App\Rankings\Services\Hero;

use App\Hero;

class StatUpdate
{
	public function __construct(Hero $hero)
	{
		$this->hero = $hero;
	}

	public function update($stats)
	{
		$hero_stats = [];

        foreach ((array)$stats as $key => $stat) {
            $hero_stats[snake_case($key)] = $stat;
        }

        $this->hero->stats()->updateOrCreate([
            'hero_id' => $this->hero->id,
            'profile_id' => $this->hero->profile->id
        ], $hero_stats);
	}
}