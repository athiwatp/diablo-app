<?php

namespace App\Rankings\API;

use johnleider\BattleNet\Diablo;
use stdClass;

class DiabloAPI
{
    public $api;

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
     * @var array
     */
    private $modes = [
        'season',
        'era'
    ];

    /**
     * DiabloAPI constructor
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
     * @param string $battle_tag
     * @param int $hero_id
     * @param string $region
     * @return stdClass
     */
    public function hero(string $battle_tag, int $hero_id, string $region) : stdClass
    {
        $hero = $this->api->setRegion($region)
            ->hero($battle_tag, $hero_id)
            ->get()[0]
            ->getBody()
            ->getContents();

        return json_decode($hero);
    }

    /**
     * @param string $battle_tag
     * @param string $region
     * @return stdClass
     */
    public function profile(string $battle_tag, string $region) : stdClass
    {
        $profile = $this->api->setRegion($region)
            ->careerProfile($battle_tag)
            ->get()[0]
            ->getBody()
            ->getContents();

        return json_decode($profile);
    }

    /**
     * @param array $items
     * @return array
     */
    public function items(array $items) : array
    {
        $this->api->setRegion('us');

        foreach ($items as $item) {
            $this->api->item($item);
        }

        return $this->api->get();
    }

    /**
     * @return array
     */
    public function skills() : array
    {
        $this->api->setRegion('us');

        return $this->api->skills('barbarian')
            ->skills('crusader')
            ->skills('demon-hunter')
            ->skills('monk')
            ->skills('witch-doctor')
            ->skills('wizard')
            ->get();
    }

    /**
     * @param string $mode
     * @param int $period
     * @return array
     */
    public function leaderboards(int $period) : array
    {
        foreach ($this->regions as $region) {
            foreach($this->modes as $mode) {
                $this->api->setRegion($region)
                    ->{$mode}($period)
                    ->softcore()
                    ->barbarian()
                    ->crusader()
                    ->demonhunter()
                    ->monk()
                    ->witchdoctor()
                    ->wizard()
                    ->team(2)
                    ->team(3)
                    ->team(4)
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
        }

        return $this->api->get();
    }
}