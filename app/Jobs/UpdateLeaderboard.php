<?php

namespace App\Jobs;

use App\Rankings\Services\Leaderboards\LeaderboardService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\{
    InteractsWithQueue, SerializesModels
};

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
