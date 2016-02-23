<?php

namespace App\Http\Controllers;

use App\Diablo\Parsers\HeroParser;
use App\Hero;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Jobs\UpdateProfile;
use App\Profile;
use Carbon\Carbon;
use Diablo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ProfileController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param Profile $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        $profile->load('heroes', 'riftRankings', 'stats');

        return view('profiles.show', compact('profile')); 
    }

    public function update(Profile $profile)
    {
        $profile->api()->update();
        $profile->queued = true;
        $profile->save();

        $job = (new UpdateProfile($profile))->onQueue('profiles');

        $this->dispatch($job);
        
        return Response::json(['status' => 'queued'], 200);
    }
}
