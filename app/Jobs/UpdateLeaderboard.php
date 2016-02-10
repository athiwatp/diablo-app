<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\Diablo\Services\Leaderboards\LeaderboardService;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateLeaderboard extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    /**
     * Leaderboard service instance
     * 
     * @var object
     */
    private $service;

    /**
     * The information to be saved
     * 
     * @var stdClass
     */
    private $record;

    /**
     * Create a new job instance.
     *
     * @param $record
     */
    public function __construct($record)
    {
        $this->service = new LeaderboardService;
        $this->record = $record;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->service->save($this->record);
    }
}
