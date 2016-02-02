<?php

namespace App\Diablo\Services\Item;

use App\Item;

class ItemService
{
    /**
     * Save the item record
     *
     * @param $item
     * @return static
     */
    public function saveItem($item)
    {
        // I know this sucks, will fix later -zs
        $slot = $item->slots[0] == 'left-finger'
            ? 'finger'
            : $item->slots[0];

        $item_array = [
            'name' => $item->name,
            'battlenet_item_id' => $item->id,
            'display_color' => $item->displayColor,
            'slot' => $slot
        ];

        return Item::firstOrCreate($item_array);
    }
}