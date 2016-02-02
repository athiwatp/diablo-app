<?php

namespace App\Console\Commands;

use App\Diablo\API\DiabloAPI;
use App\Diablo\Parsers\Skill\SkillParser;
use App\Diablo\Services\Skill\SkillService;
use Illuminate\Console\Command;

class Skill extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'skill:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update skill records';

    /**
     * The DiabloAPI instance
     *
     * @var SkillService
     */
    private $api;

    /**
     * The SkillParser Instance
     *
     * @var SkillParser
     */
    private $parser;

    /**
     * The SkillService Instance
     *
     * @var SkillService
     */
    private $service;

    /**
     * Create a new command instance.
     *
     * @param \App\Diablo\API\DiabloAPI $api
     * @param SkillParser $parser
     * @param SkillService $service
     */
    public function __construct(DiabloAPI $api, SkillParser $parser, SkillService $service)
    {
        parent::__construct();

        $this->api = $api;
        $this->parser = $parser;
        $this->service = $service;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Updating skills...');
        $t = microtime(true);

        $records = $this->parser->parse($this->api->getSkillData());

        $bar = $this->output->createProgressBar(count($records['skills']) + count($records['runes']));

        foreach ($records['skills'] as $record) {
            $this->service->saveSkill($record);
            $bar->advance();
        }

        foreach ($records['runes'] as $record) {
            $this->service->saveRune($record);
            $bar->advance();
        }

        $bar->finish();
        $this->info(PHP_EOL . 'Skills updated in ' . (microtime(true) - $t) . ' seconds');
    }
}
