<?php

namespace App\Diablo\Services;

use App\Diablo\API\DiabloAPI;

abstract class Service
{
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

    /**
     * Bind the API instance to the container
     * 
     * @return void
     */
    protected function bindApiInstance()
    {
        $this->api = new DiabloAPI;
        app()->instance('api', $this->api);
    }
}