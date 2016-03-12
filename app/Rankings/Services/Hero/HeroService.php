<?php

namespace App\Rankings\Services\Hero;

use App\{Hero, Item};
use App\Rankings\Services\Service;
use Carbon\Carbon;
use App\Rankings\API\DiabloAPI;
use Response;

class HeroService extends Service
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
    public $model;

    /**
     * The api instance
     *
     * @var DiabloAPI
     */
    public $api;

    /**
     * Item update instance
     * 
     * @var ItemUpdate
     */
    private $items;

    /**
     * Legendary Power update instance
     * 
     * @var LegendaryPowerUpdate
     */
    private $legendary_powers;

    /**
     * Skill update instance
     * 
     * @var SkillUpdate
     */
    private $skills;

    /**
     * Stat update instance
     * 
     * @var StatUpdate
     */
    private $stats;

    /**
     * Follower update instance
     * 
     * @var FollowerUpdate
     */
    private $followers;

    /**
     * HeroService constructor
     *
     * @param Hero $hero
     */
    public function __construct(Hero $hero)
    {
        parent::__construct();
        
        $this->model = $hero;
        $this->items = new ItemUpdate($this->api, $hero);
        $this->legendary_powers = new LegendaryPowerUpdate($this->api, $hero);
        $this->skills = new SkillUpdate($hero);
        $this->stats = new StatUpdate($hero);
        $this->followers = new FollowerUpdate($hero);
    }

    /**
     * Update the Hero model
     * 
     * @return \App\Hero|void|Response
     */
    public function update()
    {
        $this->response = $this->api->hero(
            $this->model->battle_tag,
            $this->model->battlenet_hero_id,
            $this->model->region
        );

        if ($this->apiHasNoResponse()) {
            return Response::json('Hero record not found, please try again later', 404);
        }

        if ($this->heroLevelIsTooLow($this->response)) {
            return $this->model;
        }

        $this->model->queued = true;
        $this->model->save();
        $this->skills->update($this->response->skills);
        $this->items->update($this->response->items);
        $this->legendary_powers->update($this->response->legendaryPowers);
        $this->stats->update($this->response->stats);
        // $this->followers->update($this->response->followers);
        $this->updateModel();

        return $this->model;
    }

    /**
     * Return the update stub for the Hero model
     * 
     * @return array
     */
    private function heroStub() : array
    {
        return [
            'name' => $this->response->name,
            'level' => $this->response->level,
            'kills' => $this->response->kills->elites,
            'paragon_level' => $this->response->paragonLevel,
            'dead' => $this->response->dead
        ];
    }

    /**
     * Save the Hero Model
     * 
     * @return void
     */
    private function updateModel()
    {
        $this->model->fill($this->heroStub());
        $this->model->queued_at = Carbon::now();
        $this->model->queued = false;
        $this->model->save();
    }
}