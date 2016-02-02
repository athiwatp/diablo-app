<?php

namespace App\Console\Commands;

use App\Diablo\API\DiabloAPI;
use App\Hero;
use App\Leaderboard as Leader;
use Illuminate\Console\Command;

class TopHundred extends Command
{
    private $api;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tophundred:update';

    /**
     * The console command description
     *
     * @var string
     */
    protected $description = 'Update ladder records';

    /**
     * Create a new command instance.
     *
     * @param DiabloAPI $api
     */
    public function __construct(DiabloAPI $api) {
        parent::__construct();

        $this->api = $api;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $t = microtime(true);

        $records = Hero::where('players', 1)
            ->join('leaderboards', 'leaderboards.hero_id', '=', 'heroes.id')
            ->join('profiles', 'profiles.id', '=', 'leaderboards.profile_id')
            ->where('leaderboards.period', '=', 5)
            ->where('leaderboards.season', '=', 1)
            ->orderBy('leaderboards.rift_level', 'desc')
            ->limit(15)
            ->select('heroes.*')
            ->get();

        $bar = $this->output->createProgressBar(count($records));

        foreach ($records as $record) {
            $record->api()->update();
            $bar->advance();
        }

        $bar->finish();

        $this->info(microtime(true) - $t);
    }
}
