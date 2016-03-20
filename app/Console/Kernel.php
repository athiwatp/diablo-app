<?php

namespace App\Console;

use App\Console\Commands\UpdateLeaderboards;
use App\Console\Commands\UpdateSkills;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\Crud::class,
        Commands\UpdateLeaderboards::class,
        Commands\UpdateSkills::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('leaderboard:update season 5 softcore')
            ->twiceDaily(0, 12);
        $schedule->command('leaderboard:update season 5 hardcore')
            ->twiceDaily(1, 13);
    }
}
