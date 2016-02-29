<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Jobs\UpdateProfile;
use App\Profile;
use Response;
use View;

class ProfileController extends Controller
{
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
    public function update(Profile $profile) : string
    {
        $job = (new UpdateProfile($profile))->onQueue('profiles');

        $this->dispatch($job);
        
        return Response::json(['queued' => true], 200);
    }
}
