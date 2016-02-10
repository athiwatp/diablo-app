<?php

namespace App\Console\Commands;

use App\Diablo\Services\Leaderboards\LeaderboardService;
use App\Diablo\Parsers\Leaderboards\LeaderboardParser;
use App\Diablo\API\DiabloAPI;
use App\Jobs\UpdateLeaderboard;
use Illuminate\Console\Command;
use Illuminate\Foundation\Bus\DispatchesJobs;

class Leaderboard extends Command
{
    use DispatchesJobs;
    
    private $service;
    private $api;
    private $parser;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'leaderboard:update {mode} {period} {limit}';

    /**
     * The console command description
     *
     * @var string
     */
    protected $description = 'Update ladder records';

    /**
     * Create a new command instance.
     *
     * @param LeaderboardParser $parser
     * @param DiabloAPI $api
     * @param LeaderboardService $service
     */
    public function __construct(
        LeaderboardParser $parser,
        LeaderboardService $service,
        DiabloAPI $api
    ) {
        parent::__construct();

        $this->parser = $parser;
        $this->api = $api;
        $this->service = $service;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->call('skill:update');

        $this->info('Updating leaderboards...');
        $t = microtime(true);

        $request = $this->api->getLeaderboardData(
            $this->argument('mode'),
            $this->argument('period')
        );

        $rankings = $this->parser->parse($request, $this->argument('limit'));

        $bar = $this->output->createProgressBar(count($rankings));
        foreach ($rankings as $record) {
            if (is_null($record['battle_tag'])) {
                continue;
            }

            $this->dispatch(new UpdateLeaderboard($record));

            $bar->advance();
        }

        $bar->finish();

        $this->info(PHP_EOL . 'Leaderboard updated in ' . (microtime(true) - $t) . ' seconds');
    }
}
