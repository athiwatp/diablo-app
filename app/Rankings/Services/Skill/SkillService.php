<?php

namespace App\Rankings\Services\Skill;

use App\Rankings\Parsers\Skill\SkillParser;
use App\Rankings\Services\Service;
use App\Rune;
use App\Skill;

class SkillService extends Service
{
    /**
     * @var SkillParser
     */
    private $parser;

    /**
     * SkillService constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->parser = new SkillParser;
    }

    /**
     * Update the skill and rune records
     */
    public function update()
    {
        $records = $this->parser
            ->parse($this->api->skills());

        $this->updateSkills($records['skills']);
        $this->updateRunes($records['runes']);
    }

    /**
     * @param array $skills
     */
    public function updateSkills(array $skills)
    {
        foreach ($skills as $skill) {
            $this->saveSkill($skill);
        }
    }

    /**
     * @param array $runes
     */
    public function updateRunes(array $runes)
    {
        foreach ($runes as $rune) {
            $this->saveRune($rune);
        }
    }

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