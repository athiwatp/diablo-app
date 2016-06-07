<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    /**
     * The fillable attributes on the Model
     *
     * @var array
     */
    protected $fillable = [
        'slug',
        'name',
        'type',
        'tool_tip_url',
        'icon'
    ];

    /**
     * A Skill belongs to many Heroes
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function heroes()
    {
        return $this->belongsToMany(Hero::class);
    }
}
