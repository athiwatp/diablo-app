<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LegendaryPower extends Model
{
    protected $fillable = [
        'name',
        'display_color',
        'tool_tip_params'
    ];
}
