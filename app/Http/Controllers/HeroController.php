<?php

namespace App\Http\Controllers;

use App\Hero;
use App\Http\Controllers\Controller;
use App\Http\Requests;
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
     * @param Hero $hero
     * @return \Illuminate\Contracts\View\Factory|View
     */
    public function show(Hero $hero) : View
    {
        $hero->load(['seasonRankings', 'items', 'profile', 'powers', 'stats', 'skills']);

        return view('heroes.show', compact('hero'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Hero $hero
     * @return string
     */
    public function update(Hero $hero) : string
    {
        $hero->queued = true;
        $hero->save();

        $job = (new UpdateHero($hero))->onQueue('heroes');

        $this->dispatch($job);
        
        return Response::json(['status' => 'queued'], 200);
    }
}
