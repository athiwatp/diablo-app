<?php

namespace App\Http\Controllers;

use App\Hero;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Item;
use App\Jobs\UpdateHero;
use Cache;
use Diablo;
use Request;
use Response;
use Illuminate\View\View;

class HeroController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(int $id) : View
    {
        return view('heroes.show', compact('id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Hero $hero
     * @return mixed
     */
    public function update(Hero $hero)
    {
        $hero->load('profile');

        $this->dispatch(new UpdateHero($hero));

        if (Cache::get('jobCount') < 10) {
            $hero->api()->update();

            return $hero->fresh()
                ->load(['leaderboards', 'items', 'profile', 'powers', 'stats', 'skills'])
                ->toJson();
        } 

        return Response::json(['status' => 'queued'], 200);
    }

    /**
     * API Methods
     */

    /**
     * Display the specified resource.
     *
     * @param Hero $hero
     * @return string
     */
    public function showApi(Hero $hero) : string
    {
        return $hero->load(['leaderboards', 'items', 'profile', 'powers', 'stats', 'skills'])
            ->toJson();
    }
}
