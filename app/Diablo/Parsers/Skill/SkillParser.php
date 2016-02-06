<?php

namespace App\Diablo\Parsers\Skill;

class SkillParser
{
	public function parse($request)
	{
		$skills = $runes = [];
        foreach ($request as $response) {
            foreach ($response->skills->active as $active_skills) {
                $skills[] = [
                	'name' => $active_skills->name, 
                	'slug' => $active_skills->slug,
                	'type' => 'active',
                	'tool_tip_url' => $active_skills->tooltipUrl,
                    'icon' => $active_skills->icon
            	];

                foreach ($active_skills->runes as $rune) {
                    $runes[] = [
	                	'name' => $rune->name, 
	                	'slug' => $rune->slug,
	                	'tool_tip_params' => $rune->tooltipParams
	            	];
                }
            }

            foreach ($response->skills->passive as $passive_skills) {
                $skills[] = [
                	'name' => $passive_skills->name, 
                	'slug' => $passive_skills->slug,
                	'type' => 'passive',
                	'tool_tip_url' => $passive_skills->tooltipUrl,
                    'icon' => $passive_skills->icon
            	];
            }
        }

        return compact('skills', 'runes');
	}
}