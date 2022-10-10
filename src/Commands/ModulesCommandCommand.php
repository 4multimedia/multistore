<?php

namespace MultiMedia\MultiStore\Commands;

use Illuminate\Console\Command;
use MultiMedia\MultiStore\Support\Stub;

class ModulesCommandCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'modules:command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new command to exists module';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $array = [];
        $array["module"] = $this->ask('Enter module name');
        $array["class"] = $this->ask('Enter command name');

        return (new Stub('Command', $array))->save();
    }
}
