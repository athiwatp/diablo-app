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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profiles = Profile::paginate(25);

        return view('profiles.index', compact('profiles'));
    }

    /**
     * Display the specified resource.
     *
     * @param Profile $profile
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function show(Profile $profile)
    {
        $profile->load(['heroes' => function ($q) {
            $q->with('soloRift')
                ->orderBy('season', 'desc')
                ->orderBy('created_at', 'asc');
        }]);

        return view('profiles.show', compact('profile')); 
    }

    public function update(Profile $profile)
    {
        return redirect()
            ->back();
    }
}
