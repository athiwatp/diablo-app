<?php

namespace App\Diablo\API;

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
    public function getLeaderboardData($mode, $period)
    {
        $request = [];

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

            $request = array_merge($request, $this->api->get());
        }

        return $request;
    }

    /**
     * Query Battlenet API for Skills
     */
    public function getSkillData()
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
}