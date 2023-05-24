<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;

class CreateTraitCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:trait {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to create a trait';

    protected $type = 'trait';

    protected function getStub()
    {
        return base_path('stubs/trait.stub');
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Traits';
    }
}
