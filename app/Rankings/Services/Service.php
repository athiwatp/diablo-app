<?php

namespace App\Rankings\Services;

abstract class Service
{
    /**
     * Service constructor
     */
    public function __construct()
    {
        $this->api = $this->app('DiabloAPI');
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
     * Get response from API
     * 
     * @return void
     */
    protected function callApi()
    {
        $this->response = $this->api->{$this->update_method}($this->model);
    }
}