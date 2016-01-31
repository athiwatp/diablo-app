<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rune extends Model
{
    protected $fillable = [
        'name', 'slug', 'tool_tip_params'
    ];
}
