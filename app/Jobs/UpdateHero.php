<?php

namespace App\Jobs;

use App\Hero;
use App\Jobs\Job;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateHero extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $hero;

    /**
     * Create a new job instance.
     *
     * @param Hero $hero
     */
    public function __construct(Hero $hero)
    {
        $this->hero = $hero;
    }

    /**
     * Execute hero update job.
     *
     * @return void
     */
    public function handle()
    {
        $this->hero->api()
            ->update();
    }
}
