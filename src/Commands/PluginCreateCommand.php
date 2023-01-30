<?php

namespace Multimedia\Multistore\Commands;

use Illuminate\Console\Command;

class PluginCreateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'modules:plugin.create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new plugin';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
		$plugin = $this->ask('Enter plugin name');


	}
}
