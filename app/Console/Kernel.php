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
        $schedule->command('leaderboard:update classes season 5 softcore')
            ->daily(0);
        $schedule->command('leaderboard:update classes season 5 hardcore')
            ->daily(1);

        $schedule->command('leaderboard:update teams season 5 softcore')
            ->daily(2);
        $schedule->command('leaderboard:update teams season 5 hardcore')
            ->daily(3);

        $schedule->command('leaderboard:update classes era 5 softcore')
            ->daily(4);
        $schedule->command('leaderboard:update classes era 5 hardcore')
            ->daily(5);
        
        $schedule->command('leaderboard:update teams era 5 softcore')
            ->daily(6);
        $schedule->command('leaderboard:update teams era 5 hardcore')
            ->daily(7);
    }
}
