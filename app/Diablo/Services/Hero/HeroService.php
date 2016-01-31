<?php

namespace App\Diablo\Services;

use App\HeroSkill;
use App\Item;
use App\LegendaryPower;
use App\Skill;
use App\Hero;
use Diablo;
use stdClass;

class HeroService
{
   /**
    * Response object
    *
    * @var
    */
   public $response;

   /**
    * HeroService constructor
    *
    * @param Hero $hero
    */
   public function __construct(Hero $hero)
   {
   		$this->model = $hero;
   }

   /**
    * Perform API Request and start update
    */
   public function update()
   {
       Diablo::setRegion($this->model->region);

       Diablo::hero(
           $this->model->profile->battle_tag,
           $this->model->battlenet_hero_id
       );

       $this->updateHero(Diablo::get());
   }

   /**
    * Perform Hero and auxiliary table updates
    *
    * @param $response
    * @return Hero
    */
   private function updateHero(stdClass $response) : Hero
   {
       Diablo::setRegion('us');

       if (isset($response->code)) {
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
    *
    * @param $items
    */
   private function updateItems($items)
   {
       $hero_items = [];
       $db_items = Item::get(['id', 'battlenet_item_id']);

       foreach ($items as $slot => $hero_item) {
           $hero_item_array = [
               'battlenet_item_id' => $hero_item->id,
               'slot' => $slot,
               'display_color' => $hero_item->displayColor
           ];

           $item = $db_items->filter(function ($i) use ($hero_item) {
               return $i->battlenet_item_id === $hero_item->id;
           })->first();

           if (is_null($item)) {
               $response = Diablo::item($hero_item->id)
                   ->get();

               $item = Item::create(array_merge(
                   $hero_item_array,
                   ['name' => $response->name]
               ));
           }

           $hero_items[] = [
               'item_id' => $item->id,
               'tool_tip_params' => $hero_item->tooltipParams
           ];
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
    *
    * @param $legendaryPowers
    */
   private function updateLegendaryPowers($legendaryPowers)
   {
       foreach ($legendaryPowers as $legendaryPower) {
           $hero_item_array = [
               'battlenet_item_id' => $legendaryPower->id,
               'slot' => 'kanai',
               'display_color' => $legendaryPower->displayColor
           ];

           $power = Item::where($hero_item_array)
               ->first();

           if (is_null($power)) {
               $response = Diablo::item($legendaryPower->id)
                   ->get();

               $power = Item::create(array_merge(
                   $hero_item_array,
                   [
                       'name' => $response->name
                   ]
               ));
           }

           $powers[] = $power->id;
       }

       if (! empty($powers)) {
           $this->model->powers()->sync($powers);
       }
   }

   /**
    * Update Hero's stats
    *
    * @param $stats
    */
   private function updateStats($stats)
   {
       $hero_stats = [];

       foreach ((array) $stats as $key => $stat) {
           $hero_stats[snake_case($key)] = $stat;
       }

       $this->model->stats()->updateOrCreate([
           'hero_id' => $this->model->id,
           'profile_id' => $this->model->profile->id
       ], $hero_stats);
   }
}