<?php

namespace App\Http\Controllers;

use App\Diablo\Parsers\HeroParser;
use App\Hero;
use App\Profile;
use Carbon\Carbon;
use Diablo;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param Profile $profile
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function show(Profile $profile)
    {
        $profile->load('heroes', 'riftRankings');

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
