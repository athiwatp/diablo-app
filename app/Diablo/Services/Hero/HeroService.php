<?php

namespace App\Diablo\Services\Hero;

use App\Diablo\API\DiabloAPI;
use App\{Hero, Item};
use Carbon\Carbon;

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
     * The api instance
     *
     * @var DiabloAPI
     */
    private $api;

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
        $this->bindApiInstance();
        $this->model = $hero;
        $this->items = new ItemUpdate($hero);
        $this->legendary_powers = new LegendaryPowerUpdate($hero);
        $this->skills = new SkillUpdate($hero);
        $this->stats = new StatUpdate($hero);
        $this->followers = new FollowerUpdate($hero);
    }

    /**
     * Update the Hero model
     * 
     * @return App\Hero|void
     */
    public function update()
    {
        $this->callApi();

        if ($this->apiHasNoResponse()) {
            return;
        }

        if ($this->heroLevelIsTooLow()) {
            return;
        }

        $this->skills->update($this->response->skills);
        $this->items->update($this->response->items);
        $this->legendary_powers->update($this->response->legendaryPowers);
        $this->stats->update($this->response->stats);
        // $this->followers->update($this->response->followers);
        $this->updateModel($this->response);

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
     * Check if hero level is too low
     * 
     * @return boolean
     */
    private function heroLevelIsTooLow() : bool
    {
        return $this->response->level < 65;
    }

    /**
     * Check for valid response from API
     * 
     * @return boolean
     */
    private function apiHasNoResponse() : bool
    {
        return isset($this->response->code) || is_null($this->response);
    }

    /**
     * Get response from API
     * 
     * @return void
     */
    private function callApi()
    {
        $this->response = $this->api->getHeroData($this->model);
        dd($this->response);
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

    /**
     * Bind the API instance to the container
     * 
     * @return void
     */
    private function bindApiInstance()
    {
        $this->api = new DiabloAPI;
        app()->instance('api', $this->api);
    }
}