<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Jobs\UpdateProfile;
use App\Profile;
use App\Rankings\Services\Profile\ProfileService;
use Illuminate\Http\Request;
use Response;
use View;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $data = $this->search($request);
        } else {
            $data = '';
        }

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

    /**
     * TODO: This needs to be extracted
     * @param Request $request
     * @return mixed
     */
    public function search(Request $request)
    {
        $search = $request->get('search');
        $profile_service = new ProfileService;

        $profile_service->search($search);

        return Profile::where('battle_tag', 'like', '%'.$search.'%')
            ->get()
            ->toJson();
    }
}
