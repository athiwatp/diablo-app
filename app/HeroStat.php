<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HeroStat extends Model
{
    protected $fillable = [
        'profile_id',
        'hero_id',
        'life',
        'damage',
        'toughness',
        'healing',
        'attack_speed',
        'armor',
        'strength',
        'dexterity',
        'vitality',
        'intelligence',
        'physical_resist',
        'fire_resist',
        'cold_resist',
        'lightning_resist',
        'crit_damage',
        'block_chance',
        'block_amount_min',
        'block_amount_max',
        'damage_increase',
        'crit_chance',
        'damage_reduction',
        'thorns',
        'life_steal',
        'life_per_kill',
        'gold_find',
        'magic_find',
        'life_on_hit',
        'primary_resource',
        'secondary_resource',
    ];
}
