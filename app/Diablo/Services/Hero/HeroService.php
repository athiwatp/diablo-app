<?php

namespace App\Diablo\Services\Hero;

use App\Diablo\API\DiabloAPI;
use App\Diablo\Services\Item\ItemService;
use App\{Hero, HeroSkill, Item, Skill};

class HeroService
{
    /**
     * Response object
     *
     * @var
     */
    public $response;

    /**
     * The modal instance
     *
     * @var Hero
     */
    private $model;

    /**
     * The Item Service instance
     *
     * @var ItemService
     */
    private $item_service;

    /**
     * The api instance
     *
     * @var DiabloAPI
     */
    private $api;

    /**
     * HeroService constructor
     *
     * @param Hero $hero
     */
    public function __construct(Hero $hero)
    {
        $this->api = new DiabloAPI;
        $this->model = $hero;
        $this->item_service = new ItemService;
    }

    /**
     * Perform API Request and start update
     *
     * @param $response
     * @return \Hero|void
     */
    public function update($response = null)
    {
        if (is_null($response)) {
            $response = $this->callApi();
        }

        if (isset($response->code) || is_null($response)) {
            return;
        }

        if ($response->level < 65) {
            return;
        }

        $this->model->update([
            'name' => $response->name,
            'level' => $response->level,
            'kills' => $response->kills->elites,
            'paragon_level' => $response->paragonLevel,
            'dead' => $response->dead
        ]);

        $this->updateSkills($response->skills);
        $this->updateItems($response->items);
        $this->updateFollowers($response->followers);
        $this->updateLegendaryPowers($response->legendaryPowers);
        $this->updateStats($response->stats);

        return $this->model;
    }

    /**
     * Update active and passive skills
     *
     * @param $skills
     */
    private function updateSkills($skills)
    {
        $passive_skills = $active_skills = [];
        $db_skills = Skill::get(['id', 'slug']);

        foreach ($skills->active as $active) {
            $skill = $db_skills->filter(function ($i) use ($active) {
                return $i->slug === $active->skill->slug;
            })->first();

            $active_skills[] = $skill->id;
        }

        foreach ($skills->passive as $passive) {
            $skill = $db_skills->filter(function ($i) use ($passive) {
                return $i->slug === $passive->skill->slug;
            })->first();

            $passive_skills[] = $skill->id;
        }

        $sync_skills = array_merge($active_skills, $passive_skills);

        $this->model->skills()
            ->sync($sync_skills);
    }

    /**
     * Update equipped items
     * TODO: Need to update this process, it is a bit redundant, but for now, once we have the items filled in the db, it won't be used very often
     *
     * @param $items
     */
    private function updateItems($items)
    {
        $hero_items = $query_items = [];
        $db_items = Item::get(['id', 'battlenet_item_id']);

        foreach ($items as $slot => $hero_item) {
            $item = $db_items->filter(function ($i) use ($hero_item) {
                return $i->battlenet_item_id === $hero_item->id;
            })->first();

            if (is_null($item)) {
                $query_items[] = $hero_item->id;

                continue;
            }

            $hero_items[$item->id] = [
                'tool_tip_params' => $hero_item->tooltipParams
            ];
        }

        if (! empty($query_items)) {
            $hero_items = [];

            $request = $this->api->getItemData($query_items);

            if (! is_array($request)) {
                $request = [$request];
            }

            foreach ($request as $response) {
                $this->item_service->saveItem($response);
            }

            $db_items = Item::get(['id', 'battlenet_item_id']);

            foreach ($items as $slot => $hero_item) {
                $item = $db_items->filter(function ($i) use ($hero_item) {
                    return $i->battlenet_item_id === $hero_item->id;
                })->first();

                if (is_null($item)) {
                    continue;
                }

                $hero_items[$item->id] = [
                    'tool_tip_params' => $hero_item->tooltipParams
                ];
            }
        }

        $this->model->items()
            ->sync($hero_items);
    }

    /**
     * Update Follower equipped items
     *
     * @param $followers
     */
    private function updateFollowers($followers)
    {
        //
    }

    /**
     * Update used Kanai's cube powers
     * TODO: Need to update this process, it is a bit redundant, but for now, once we have the items filled in the db, it won't be used very often
     *
     * @param $legendaryPowers
     */
    private function updateLegendaryPowers($legendaryPowers)
    {
        $powers = $query_items = [];
        $db_items = Item::get(['id', 'battlenet_item_id']);

        foreach ($legendaryPowers as $legendaryPower) {
            $item = $db_items->filter(function ($i) use ($legendaryPower) {
                return $i->battlenet_item_id === $legendaryPower->id;
            })->first();

            if (is_null($item)) {
                $query_items[] = $legendaryPower->id;

                continue;
            }

            $powers[] = [
                'item_id' => $item->id,
            ];
        }

        if (! empty($query_items)) {
            $powers = [];

            $request = $this->api->getItemData($query_items);

            if (! is_array($request)) {
                $request = [$request];
            }

            foreach ($request as $response) {
                $this->item_service->saveItem($response);
            }

            $db_items = Item::get(['id', 'battlenet_item_id']);

            foreach ($legendaryPowers as $legendaryPower) {
                $item = $db_items->filter(function ($i) use ($legendaryPower) {
                    return $i->battlenet_item_id === $legendaryPower->id;
                })->first();

                if (is_null($item)) {
                    continue;
                }

                $powers[] = [
                    'item_id' => $item->id,
                ];
            }
        }

        $this->model->powers()
            ->sync($powers);
    }

    /**
     * Update Hero's stats
     *
     * @param $stats
     */
    private function updateStats($stats)
    {
        $hero_stats = [];

        foreach ((array)$stats as $key => $stat) {
            $hero_stats[snake_case($key)] = $stat;
        }

        $this->model->stats()->updateOrCreate([
            'hero_id' => $this->model->id,
            'profile_id' => $this->model->profile->id
        ], $hero_stats);
    }

    private function callApi()
    {
        return $this->api->getHeroData($this->model);
    }
}