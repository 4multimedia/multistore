<?php

namespace Multimedia\Multistore\Commands;

use Illuminate\Console\Command;
use Multimedia\Multistore\Support\Creating;

class ModulesCreateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'modules:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new module MultiMedia module';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $module = $this->ask('Enter module name');

        return (new Creating($module))->generate();
    }
}
