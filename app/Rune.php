<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rune extends Model
{
    /**
     * The fillable attributes on the Model
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug', 'type', 'tool_tip_params'
    ];
}
