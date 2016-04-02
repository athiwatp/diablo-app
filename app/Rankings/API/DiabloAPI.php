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
        return $this->api->setRegion($region)
            ->hero($battle_tag, $hero_id)
            ->get();
    }

    /**
     * @param string $battle_tag
     * @param string $region
     * @return stdClass
     */
    public function profile(string $battle_tag, string $region) : stdClass
    {
        return $this->api->setRegion($region)
            ->careerProfile($battle_tag)
            ->get();
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

        $response = $this->api->get();

        return is_array($response)
            ? $response
            : [$response];
    }

    /**
     * @return array
     */
    public function skills() : array
    {
        $this->api->setRegion('us');

        $response = $this->api->skills('barbarian')
            ->skills('crusader')
            ->skills('demon-hunter')
            ->skills('monk')
            ->skills('witch-doctor')
            ->skills('wizard')
            ->get();

        return is_array($response)
            ? $response
            : [$response];
    }

    /**
     * @param string $mode
     * @param int $period
     * @return array
     */
    public function classes(string $mode, int $period, string $type) : array
    {
        foreach ($this->regions as $region) {
            $this->api->setRegion($region)
                ->{$mode}($period)
                ->$type()
                ->barbarian()
                ->crusader()
                ->demonhunter()
                ->monk()
                ->witchdoctor()
                ->wizard();
        }

        $response = $this->api->get();

        return is_array($response)
            ? $response
            : [$response];
    }

    /**
     * @param string $mode
     * @param int $period
     * @return array
     */
    public function teams(string $mode, int $period, string $type) : array
    {
        foreach ($this->regions as $region) {
            $this->api->setRegion($region)
                ->{$mode}($period)
                ->$type()
                ->team(2)
                ->team(3)
                ->team(4);
        }

        $response = $this->api->get();

        return is_array($response)
            ? $response
            : [$response];
    }
}