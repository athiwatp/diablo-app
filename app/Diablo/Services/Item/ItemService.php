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
        $item_array = [
            'name' => $item->name,
            'battlenet_item_id' => $item->id,
            'display_color' => $item->displayColor,
            'slot' => $item->slots[0]
        ];

        return Item::updateOrCreate($item_array);
    }
}