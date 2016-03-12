<?php

namespace App\Rankings\Services\Item;

use App\Item;
use App\Rankings\Parsers\Item\ItemParser;
use App\Rankings\Services\Service;

class ItemService extends Service
{
    public function __construct()
    {
        parent::__construct();
        $this->parser = new ItemParser;
    }

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
            'slot' => $slot,
            'tool_tip_params' => $item->tooltipParams,
            'icon' => $item->icon
        ];

        return Item::firstOrCreate($item_array);
    }
}