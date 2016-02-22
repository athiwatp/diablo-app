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

class UpdateProfile extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $profile;

    /**
     * Create a new job instance.
     *
     * @param Hero $hero
     */
    public function __construct(Hero $profile)
    {
        $this->profile = $profile;
    }

    /**
     * Execute profile update job.
     *
     * @return void
     */
    public function handle()
    {
        $this->profile->api()
            ->update();
    }
}
