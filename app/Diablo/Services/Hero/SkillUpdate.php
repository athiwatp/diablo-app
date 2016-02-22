<?php

namespace App\Diablo\Services\Hero;

use App\Hero;
use App\Rune;
use App\Skill;

class SkillUpdate
{
    private $hero;
    private $db_skills;
    private $db_runes;

	public function __construct(Hero $hero)
	{
        $this->hero = $hero;
		$this->db_skills = Skill::get(['id', 'slug']);
        $this->db_runes = Rune::get(['id', 'slug', 'type']);
	}

    public function update($skills)
    {
        $passive_skills = $active_skills = [];

        foreach ($skills->active as $active) {
            $skill = $this->db_skills->filter(function ($i) use ($active) {
                return $i->slug === $active->skill->slug;
            })->first();

            $rune = $this->db_runes->filter(function ($i) use ($active) {
                return $i->slug === $active->rune->slug;
            })->first();

            $sync_skills[$skill->id] = ['rune_id' => $rune->id];
        }

        foreach ($skills->passive as $passive) {
            $skill = $this->db_skills->filter(function ($i) use ($passive) {
                return $i->slug === $passive->skill->slug;
            })->first();

            $sync_skills[$skill->id] = ['rune_id' => null];
        }

        $this->hero->skills()
            ->sync($sync_skills);
	}
}