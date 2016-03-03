<?php

namespace App\Rankings\Parsers\Skill;

class SkillParser
{
    /**
     * Skills array
     * @var array
     */
    public $skills = [];

    /**
     * Runes array
     * @var array
     */
    public $runes = [];

    /**
     * SkillParser constructor
     * @param  $request
     * @return array
     */
	public function parse($request) : array
	{
        foreach ($request as $response) {
            $this->activeSkillsAndRunes($response);
            $this->passiveSkills($response);
        }

        return [
            'skills' => $this->skills,
            'runes' => $this->runes
        ];
	}

    /**
     * Parse passive skills
     * 
     * @return void
     */
    public function passiveSkills($response)
    {
        foreach ($response->skills->passive as $passive_skills) {
            $this->skills[] = [
                'name' => $passive_skills->name, 
                'slug' => $passive_skills->slug,
                'type' => 'passive',
                'tool_tip_url' => $passive_skills->tooltipUrl,
                'icon' => $passive_skills->icon
            ];
        }
    }

    /**
     * Parse active skills and runes
     * 
     * @return void
     */
    public function activeSkillsAndRunes($response)
    {
        foreach ($response->skills->active as $active_skills) {
            $this->skills[] = [
                'name' => $active_skills->name, 
                'slug' => $active_skills->slug,
                'type' => 'active',
                'tool_tip_url' => $active_skills->tooltipUrl,
                'icon' => $active_skills->icon
            ];

            foreach ($active_skills->runes as $rune) {
                $this->runes[] = [
                    'name' => $rune->name, 
                    'slug' => $rune->slug,
                    'type' => $rune->type,
                    'tool_tip_params' => $rune->tooltipParams
                ];
            }
        }
    }
}
