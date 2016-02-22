<?php

namespace App\Diablo\Services\Profile;

use App\Diablo\API\DiabloAPI;
use App\Diablo\Services\Service;
use App\Profile;

class ProfileService extends Service
{
    protected $update_method = 'getProfileData';

    public function __construct(Profile $profile)
    {
        $this->bindApiInstance();
        $this->model = $profile;
    }

    public function update()
    {
        $this->callApi();
        dd($this->response);
    }    
}