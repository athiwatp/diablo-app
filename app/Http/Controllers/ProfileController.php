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
        $data = $request->has('search')
            ? $this->search($request)
            : '';

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
            'seasonRankings',
            'stats'
        ]);

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

        return $profile->load([
            'heroes',
            'seasonRankings',
            'stats'
        ]);
    }

    /**
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
