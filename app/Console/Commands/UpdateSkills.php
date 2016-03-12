<?php

namespace App\Console\Commands;

use App\Rankings\API\DiabloAPI;
use App\Rankings\Parsers\Skill\SkillParser;
use App\Rankings\Services\Skill\SkillService;
use Illuminate\Console\Command;

class UpdateSkills extends Command
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
     * @param SkillParser $parser
     * @param SkillService $service
     */
    public function __construct(SkillService $service)
    {
        parent::__construct();

        $this->service = new SkillService;
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

        $this->service->update();

        $this->info(PHP_EOL . 'Skills updated in ' . (microtime(true) - $t) . ' seconds');
    }
}
