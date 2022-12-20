<?php

namespace Multimedia\Multistore\Commands;

use Illuminate\Console\Command;
use Multimedia\Multistore\Support\Stub;

class ModulesCreateMigration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'modules:migration.create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new migration to exists module';

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
            $array["table"] = $this->ask('Enter table name');

            $array["extended"] = $this->confirm('Added to extended module?', true);

            return (new Stub('migration', 'Database/Migration', $array))->save();
        }
    }
}
