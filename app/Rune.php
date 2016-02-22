<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rune extends Model
{
    protected $fillable = [
        'name', 'slug', 'type', 'tool_tip_params'
    ];
}
