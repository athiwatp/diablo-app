<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfileStat extends Model
{
	/**
	 * The fillable attributes on the Model
	 * 
	 * @var array
	 */
	protected $fillable = [
		'profile_id', 
		'clan_name', 
		'paragon_level', 
		'paragon_level_hardcore', 
		'paragon_level_season', 
		'kills_monsters', 
		'kills_elites'
	];
}
