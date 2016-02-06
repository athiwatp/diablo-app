<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'battlenet_item_id', 'slot', 'name', 'display_color', 'tool_tip_params', 'icon'
    ];

    /**
     * An Item belongs to many Heroes
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function hero()
    {
        return $this->belongsToMany(Hero::class);
    }

    /**
     * Slot accessor to capitalize slot
     *
     * @param $value
     * @return string
     */
    public function getSlotAttribute($value)
    {
        return ucwords($value);
    }
}
