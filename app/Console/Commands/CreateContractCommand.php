<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;

class CreateContractCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:contract {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to create a contract';

    protected $type = 'contract';

    protected function getStub()
    {
        return base_path('stubs/contract.stub');
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Contracts';
    }
}
