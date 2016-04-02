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
            ->twiceDaily('0:00', '12:00');
        $schedule->command('leaderboard:update classes season 5 hardcore')
            ->twiceDaily('0:05', '12:05');

        $schedule->command('leaderboard:update teams season 5 softcore')
            ->twiceDaily('1:00', '13:00');
        $schedule->command('leaderboard:update teams season 5 hardcore')
            ->twiceDaily('1:05', '13:05');

        $schedule->command('leaderboard:update classes era 5 softcore')
            ->twiceDaily('2:00', '14:00');
        $schedule->command('leaderboard:update classes era 5 hardcore')
            ->twiceDaily('2:05', '14:05');
        
        $schedule->command('leaderboard:update teams era 5 softcore')
            ->twiceDaily('3:00', '15:00');
        $schedule->command('leaderboard:update teams era 5 hardcore')
            ->twiceDaily('3:05', '15:05');
    }
}
