<?php

namespace App\Http\Controllers;

use App\Hero;
use App\Http\Controllers\Controller;
use App\Jobs\UpdateHero;
use Illuminate\Http\JsonResponse;
use Response;
use View;

class HeroController extends Controller
{
    /**
     * @return mixed
     */
    public function index()
    {
        return View::make('heroes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Hero $hero
     * @return \Illuminate\View\View
     */
    public function show(Hero $hero) : \Illuminate\View\View
    {
        $hero->load([
            'seasonRankings', 
            'items', 
            'profile', 
            'powers', 
            'stats', 
            'skills',
        ]);

        $hero->getAvailability();

        return View::make('heroes.show', compact('hero'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Hero $hero
     * @return string
     */
    public function update(Hero $hero)
    {
        $response = $hero->api()->update();

        if (!$response instanceof Hero) {
            return $response;
        }

        $hero->fresh();

        $hero->getAvailability();

        return $hero->load([
            'seasonRankings',
            'items',
            'profile',
            'powers',
            'stats',
            'skills'
        ]);
    }
}
