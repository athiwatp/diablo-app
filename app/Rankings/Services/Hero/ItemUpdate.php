<?php

namespace App\Rankings\Services\Hero;

use App\Rankings\API\DiabloAPI;
use App\Rankings\Services\Item\ItemService;
use App\Hero;
use App\Item;
use Illuminate\Database\Eloquent\Collection;
use stdClass;

class ItemUpdate
{
	public $sync_items = [];
	public $query_items = [];
	public $pending_items = [];

	/**
	 * Construct the class
	 * @param Item $item
	 */
	public function __construct(DiabloAPI $api, Hero $hero)
	{
		$this->api = $api;
		$this->hero = $hero;
		$this->db_items = Item::get(['id', 'battlenet_item_id']);
		$this->item_service = new ItemService;
	}

	/**
	 * Update the Hero model's Items
	 * @param  array  $items The API response
	 * @return void
	 */
	public function update(stdClass $items)
	{
        $this->hero->items()
            ->sync($this->items($items));
	}

	/**
	 * Get items from API Response
	 * @param  array $items
	 * @return array
	 */
	public function items(stdClass $items) : array
	{
		foreach ($items as $item) {
            if ($find = $this->findItem($item)) {
                $this->addToSync($find, $item);

                continue;
            }

            $this->addToQuery($item);
        }

     	$this->queryApi();
     	
     	return $this->mergeItems();
	}

	/**
	 * Add an item to the sync list
	 * @param \App\Item $find
	 * @param stdClass $item
	 */
	private function addToSync(Item $find, stdClass $item)
	{
		$this->sync_items[$find->id] = [
            'tool_tip_params' => $item->tooltipParams
        ];
	}

	/**
	 * Add an item to the query list
	 * @param stdClass $item
	 */
	private function addToQuery(stdClass $item)
	{
		$this->query_items[$item->tooltipParams] = $item->id;
	}

	/**
	 * Get the query items from the API
	 * @return array
	 */
	private function queryApi()
	{
		if (empty($this->query_items)) {
			return;
		}

		$request = $this->api
			->items($this->query_items);

        foreach ($request as $response) {
            $response = json_decode($response->getBody()->getContents());

            if (isset($response->code)) {
                continue;
            }

            $this->pending_items[] = $this->item_service->saveItem($response);
        }
	}

	/**
	 * Find an item in the Item list
	 * @param  integer $battlenet_item_id
	 * @return \App\Item|boolean
	 */
	private function findItem(stdClass $item)
	{
		$find = $this->db_items->filter(function ($i) use ($item) {
            return $i->battlenet_item_id === $item->id;
        })->first();

        return $find ?? false;
	}

	/**
	 * Merge the query and sync items
	 * @return array
	 */
	private function mergeItems() : array
	{
		foreach ($this->pending_items as $pending_item) {
			$tool_tip_params = array_search($pending_item->battlenet_item_id, $this->query_items);

			if (! $tool_tip_params) {
				continue;
			}

			$this->sync_items[$pending_item->id] = compact('tool_tip_params');
		}

		return $this->sync_items;
	}
}