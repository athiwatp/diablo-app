<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class Crud extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'view:crud {folder} {template}';

    /**
     * The Crud files to create.
     *
     * @var array|Filesystem
     */
    protected $templateFiles = [
        'index.blade.php',
        'create.blade.php',
        'edit.blade.php'
    ];

    /**
     * The Filesystem instance.
     *
     * @var
     */
    protected $file;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a collection of CRUD Files';

    /**
     * Create a new command instance.
     *
     * @param Filesystem $files
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $path = $this->getPath();

        $this->makeDirectory($path);

        $this->generateCrudFiles($path);

        $this->info(ucwords($this->getFolderInput()).' crud created successfully.');
    }

    /**
     * Get the view stub.
     *
     * @return string
     */
    protected function getStub()
    {
        return app_path('Console/Crud/view.stub');
    }

    /**
     * Get the folder creation path.
     *
     * @return string
     */
    protected function getPath()
    {
        return base_path('resources/views/'.$this->getFolderInput());
    }

    /**
     * Get the folder.
     *
     * @return array|string
     */
    protected function getFolderInput()
    {
        return $this->argument('folder');
    }

    /**
     * Get the template.
     *
     * @return array|string
     */
    protected function getTemplateInput()
    {
        return $this->argument('template');
    }

    /**
     * Make the folder directory.
     *
     * @param $path
     */
    protected function makeDirectory($path)
    {
        if ($this->files->isDirectory($path)) {
            $this->error($this->getFolderInput().' folder already exists');
            die;
        }

        $this->files->makeDirectory($path, 0777, true, true);
        $this->files->makeDirectory($path.'/partials', 0777, true, true);
    }

    /**
     * Build the view stub.
     *
     * @param $name
     * @return mixed
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function buildStub($name)
    {
        $stub = $this->files->get($this->getStub());

        return $this->replaceTemplate($name, $stub);
    }

    /**
     * Replace template name in stub.
     *
     * @param $name
     * @param $stub
     * @return mixed
     */
    protected function replaceTemplate($name, $stub)
    {
        return str_replace(
            'template',
            $name, $stub
        );
    }

    /**
     * Generate the crud files.
     *
     * @param $path
     */
    protected function generateCrudFiles($path)
    {
        foreach ($this->templateFiles as $file) {
            $this->files->put(
                $path.'/'.$file,
                $this->buildStub($this->getTemplateInput())
            );
        }

        $this->files->put(
            $path.'/partials/form.blade.php',
            ''
        );
    }
}
