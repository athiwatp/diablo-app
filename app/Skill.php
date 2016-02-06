<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = [
        'slug',
        'name',
        'type',
        'tool_tip_url',
        'icon'
    ];

    public function heroes()
    {
        return $this->belongsToMany(Hero::class);
    }
}
