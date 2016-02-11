<?php

namespace App\Http\Controllers;

use App\Hero;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Item;
use App\Jobs\UpdateHero;
use Cache;
use Carbon\Carbon;
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
        // TODO: Need to abstract this functionality out of the controller
        $hero = $hero->load(['leaderboards', 'items', 'profile', 'powers', 'stats', 'skills']);
        $hero->queable = is_null($hero->queued_at) || $hero->queued_at->lte(Carbon::now()->subHours(12))
            ? true
            : false;

        $hero->queable = true;

        if ($hero->queable) {
            $hero->queue_available = '';
        } else {
            $hero->queue_available = $hero->queued_at->copy()->addHours(12)->diffForHumans();
        }

        return $hero->toJson();
    }
}
