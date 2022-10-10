<?php

namespace Multimedia\Multistore\Commands;

use Illuminate\Console\Command;
use Multimedia\Multistore\Support\Stub;

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
        $array["extended"] = false;
        $array["module"] = $this->ask('Enter module name');
        $isDir = is_dir(app_path('Modules/'.$array["module"]));
        if (!$isDir) {
            $this->error('Wrong module name');
        } else {
            $array["class"] = $this->ask('Enter command name');

            $array["extended"] = $this->confirm('Added to extended module?', true);

            return (new Stub('command', 'Command', $array))->save();
        }
    }
}
