<?php

namespace App\Http\Controllers;

use App\Hero;
use App\Http\Controllers\Controller;
use App\Jobs\UpdateHero;
use Response;
use View;

class HeroController extends Controller
{
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
            'skills'
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
    public function update(Hero $hero) : string
    {
        $job = (new UpdateHero($hero))->onQueue('heroes');

        $this->dispatch($job);
        
        return Response::json(['queued' => true], 200);
    }
}
