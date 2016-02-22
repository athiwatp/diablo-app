<?php

namespace App\Diablo\API;

use App\Hero;
use johnleider\BattleNet\Diablo;

class DiabloAPI
{
    /**
     * Regions
     *
     * @var array
     */
    private $regions = [
        'us',
        'eu',
        'kr',
        'tw'
    ];

    /**
     * Diablo constructor
     */
	public function __construct()
	{
		$this->api = new Diablo(
            env('BATTLENET_API_KEY'),
            env('BATTLENET_API_SECRET'),
            env('BATTLENET_API_TOKEN')
        );
	}

    /**
     * Query Battlenet API for Leaderboards
     *
     * @param $mode
     * @param $period
     * @return array
     */
    public function getLeaderboardData(string $mode, int $period) : array
    {
        foreach ($this->regions as $region) {
            $this->api->setRegion($region);

            $this->api->$mode($period)
                ->softcore()
                ->barbarian()
                ->crusader()
                ->demonhunter()
                ->monk()
                ->witchdoctor()
                ->wizard()
                ->team(2)
                ->team(3)
                ->team(4);

            $this->api->$mode($period)
                ->hardcore()
                ->barbarian()
                ->crusader()
                ->demonhunter()
                ->monk()
                ->witchdoctor()
                ->wizard()
                ->team(2)
                ->team(3)
                ->team(4);
        }

        return $this->api->get();
    }

    /**
     * Query Battlenet API for Skills
     *
     * @return array
     */
    public function getSkillData() : array
    {
        $this->api->setRegion('us');

        $request = $this->api->skills('barbarian')
            ->skills('crusader')
            ->skills('demon-hunter')
            ->skills('monk')
            ->skills('witch-doctor')
            ->skills('wizard');

        return $request->get();
    }

    /**
     * Query Battlenet API for Hero
     *
     * @param $heroes
     * @return array|Diablo|\stdClass
     */
    public function getHeroData(Hero $hero)
    {
        $this->api->setRegion($hero->region);

        return $this->api
            ->hero($hero->profile->battle_tag, $hero->battlenet_hero_id)
            ->get();
    }

    /**
     * Query Battlenet API for Item
     *
     * @param $items
     * @return array|Diablo|\stdClass
     */
    public function getItemData($items)
    {
        $this->api->setRegion('us');

        foreach ($items as $item) {
            $this->api->item($item);
        }

        return $this->api->get();
    }

    /**
     * Query Battlenet API for Profile
     * @param  $profile
     * @return stdClass
     */
    public function getProfileData($profile)
    {
        $this->api->setRegion($profile->region);
        $this->api->careerProfile($profile->battle_tag);

        return $this->api->get();
    }
}