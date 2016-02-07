<?php

namespace App\Console\Commands;

use App\Diablo\API\DiabloAPI;
use App\Hero;
use App\Jobs\UpdateHero;
use Illuminate\Console\Command;
use Illuminate\Foundation\Bus\DispatchesJobs;

class TopHundred extends Command
{
    use DispatchesJobs;

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

        $records = Hero::join('leaderboards', function ($join) {
            $join->on('leaderboards.hero_id', '=', 'heroes.id')
                ->where('leaderboards.season', '=', 1)
                ->where('leaderboards.players', '=', 1)
                ->where('leaderboards.hardcore', '=', 0);
        })
            ->orderBy('leaderboards.rift_level', 'desc')
            ->limit(100)
            ->get();

        $bar = $this->output->createProgressBar(count($records));

        foreach ($records as $record) {
            $this->dispatch(new UpdateHero($record));
            $bar->advance();
        }

        $bar->finish();

        $this->info(microtime(true) - $t);
    }
}
