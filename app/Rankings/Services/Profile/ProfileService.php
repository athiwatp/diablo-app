<?php

namespace App\Rankings\Services\Profile;

use App\Rankings\Services\Service;
use App\Hero;
use App\Profile;
use App\ProfileStat;
use Carbon\Carbon;
use stdClass;

class ProfileService extends Service
{
    protected $update_method = 'getProfileData';

    public function __construct(Profile $profile)
    {
        $this->model = $profile;
        $this->stats_model = new ProfileStat;
    }

    public function update()
    {
        $this->callApi();
        
        if ($this->apiHasNoResponse()) {
            return;
        }

        $this->updateHeroes();
        $this->updateModel();
    }

    public function updateHeroes()
    {
        foreach ($this->response->heroes as $hero) {
            $hero = $this->parseHero($hero);

            Hero::updateOrCreate([
                'battlenet_hero_id' => $hero['id'],
                'profile_id' => $this->model->id
            ], $hero);
        }
    }

    public function parseHero(stdClass $record)
    {
        $hero = [];

        foreach ($record as $key => $data) {
            $key = snake_case($key);
            $hero[$key] = $data;
        }

        $hero['kills'] = $hero['kills']->elites;
        $hero['season'] = $hero['seasonal'] == true
            ? true
            : false;

        return $hero;
    }

    public function updateModel()
    {
        $this->model->queued_at = Carbon::now();
        $this->model->queued = false;
        $this->model->save();

        $this->updateStats();
    }

    public function updateStats()
    {
        ProfileStat::updateOrCreate([
            'profile_id' => $this->model->id
        ], $this->statStub());
    }

    public function statStub()
    {
        return [
            'clan_name' => $this->response->guildName,
            'paragon_level' => $this->response->paragonLevel,
            'paragon_level_hardcore' => $this->response->paragonLevelHardcore,
            'paragon_level_season' => $this->response->paragonLevelSeason,
            'paragon_level_season_hardcore' => $this->response->paragonLevelSeasonHardcore,
            'kills_monsters' => $this->response->kills->monsters,
            'kills_elites' => $this->response->kills->elites
        ];
    }
}