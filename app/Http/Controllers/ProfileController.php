<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Jobs\UpdateProfile;
use App\Profile;
use App\Rankings\Services\Profile\ProfileService;
use Response;
use View;

class ProfileController extends Controller
{
    public function index()
    {
        $data = '';

        return View::make('profiles.index', compact('data'));
    }

    /**
     * Display the specified resource.
     *
     * @param Profile $profile
     * @return \Illuminate\View\View
     */
    public function show(Profile $profile) : \Illuminate\View\View
    {
        $profile->load([
            'heroes', 
            'riftRankings', 
            'stats'
        ]);

        $profile->getAvailability();

        return View::make('profiles.show', compact('profile')); 
    }

    /**
     * Update Profile
     * 
     * @param  Profile $profile
     * @return string
     */
    public function update(Profile $profile)
    {
        $response = $profile->api()->update();

        if (!$response instanceof Profile) {
            return $response;
        }

        $profile->fresh();

        $profile->getAvailability();

        return $profile->load([
            'heroes',
            'riftRankings',
            'stats'
        ]);
    }
}
