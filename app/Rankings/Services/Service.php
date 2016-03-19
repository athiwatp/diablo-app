<?php

namespace App\Rankings\Services;

use App\Rankings\API\DiabloAPI;

abstract class Service
{
    /**
     * @var mixed
     */
    public $api;

    /**
     * Service constructor
     */
    public function __construct()
    {
        $this->api = new DiabloAPI;
    }

    /**
     * Check for valid response from API
     * 
     * @return boolean
     */
    protected function apiHasNoResponse() : bool
    {
        return isset($this->response->code) || is_null($this->response);
    }

    /**
     * Check if hero level is too low
     *
     * @return boolean
     */
    protected function heroLevelIsTooLow($hero) : bool
    {
        return $hero->level < 65;
    }
}