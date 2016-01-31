<?php

namespace App\Http\Controllers;

use App\Hero;
use App\Item;
use Diablo;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class HeroController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        return view('heroes.show', compact('id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Hero $hero
     * @return \Illuminate\Http\Response
     */
    public function update(Hero $hero)
    {
        $hero->load('profile');

        $hero->api()->update();

        return $hero->fresh()
            ->load(['leaderboards', 'items', 'profile', 'powers', 'stats', 'skills']);
    }

    /**
     * API Methods
     */

    /**
     * Display the specified resource.
     *
     * @param Hero $hero
     * @return \Illuminate\Http\Response
     */
    public function showApi(Hero $hero)
    {
        return $hero->load(['leaderboards', 'items', 'profile', 'powers', 'stats', 'skills'])
            ->toJson();
    }
}
