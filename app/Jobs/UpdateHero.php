<?php

namespace App\Jobs;

use App\Hero;
use App\Jobs\Job;
use Log;
use Cache;
use Carbon\Carbon;
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
     * @return void
     */
    public function __construct(Hero $hero)
    {
        $this->hero = $hero;

        Cache::increment('jobCount');
        Log::debug('Job count: ' . Cache::get('jobCount'));
    }

    /**
     * Execute hero update job.
     *
     * @return void
     */
    public function handle()
    {
        // Do nothing if hero was updated in the last 5 minutes.
        if (Carbon::now()->diffInMinutes($this->hero->fresh()->updated_at) > 5) {
            $this->hero->api()->update();
        }
    }
}
