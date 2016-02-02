<?php

namespace App\Diablo\Services\Skill;

use App\Rune;
use App\Skill;

class SkillService
{
    /**
     * Save the skill record
     *
     * @param $skill
     */
	public function saveSkill($skill)
	{
		Skill::updateOrCreate($skill);
	}

    /**
     * Save the rune record
     *
     * @param $rune
     */
    public function saveRune($rune)
    {
        Rune::updateOrCreate($rune);
    }
}