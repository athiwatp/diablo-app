<?php

namespace App\Rankings\Services\Hero;

use App\Rankings\Services\Item\ItemService;
use App\{Hero, Item};
use stdClass;

class LegendaryPowerUpdate
{
    private $api;
    private $hero;
    private $db_items;
    private $item_service;
    private $sync_powers = [];
    private $query_powers = [];
    private $pending_powers = [];

	public function __construct(DiabloAPI $api, Hero $hero)
	{
        $this->api = $api;
		$this->hero = $hero;
        $this->db_items = Item::get(['id', 'battlenet_item_id']);
        $this->item_service = new ItemService;
	}

	public function update($legendaryPowers)
	{
        $this->hero->powers()
            ->sync($this->powers($legendaryPowers));
	}

    private function powers($legendaryPowers)
    {
        foreach ($legendaryPowers as $legendaryPower) { 
            if ($find = $this->findPower($legendaryPower)) {
                $this->addToSync($find, $legendaryPower);

                continue;
            }

            $this->addToQuery($legendaryPower);
        }

        $this->queryApi();
        
        return $this->mergePowers();
    }

    /**
     * Add an item to the sync list
     * @param App\Item $find
     * @param stdClass $item
     */
    private function addToSync(Item $find)
    {
        $this->sync_powers[] = $find->id;
    }

    /**
     * Add an item to the query list
     * @param stdClass $item
     */
    private function addToQuery(stdClass $legendaryPower)
    {
        $this->query_powers[] = $legendaryPower->id;
    }

    /**
     * Get the query items from the API
     * @return array
     */
    private function queryApi()
    {
        if (empty($this->query_items)) {
            return [];
        }

        $request = $this->api
            ->getItemData($this->query_powers);

        if (! is_array($request)) {
            $request = [$request];
        }

        foreach ($request as $response) {
            $this->pending_powers[] = $this->item_service->saveItem($response);
        }
    }

    /**
     * Find an item in the Item list
     * @param  integer $battlenet_item_id
     * @return App\Item|boolean
     */
    private function findPower(stdClass $legendaryPower)
    {
        $find = $this->db_items->filter(function ($i) use ($legendaryPower) {
            return $i->battlenet_item_id === $legendaryPower->id;
        })->first();

        return $find ?? false;
    }

    /**
     * Merge the query and sync items
     * @return array
     */
    private function mergePowers() : array
    {
        foreach ($this->pending_powers as $pending_power) {
            $this->sync_powers[] = $pending_power->id;
        }

        return $this->sync_powers;
    }
}