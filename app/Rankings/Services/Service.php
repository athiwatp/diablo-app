<?php

namespace App\Rankings\Services;

abstract class Service
{
    public $api;

    /**
     * Service constructor
     */
    public function __construct()
    {
        $this->api = app()->make('DiabloAPI');
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
}