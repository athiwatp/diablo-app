<?php

namespace App\Diablo\Services;

use App\Diablo\API\DiabloAPI;

abstract class Service
{
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