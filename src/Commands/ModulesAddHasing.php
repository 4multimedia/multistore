<?php

namespace Multimedia\Multistore\Commands;

use Illuminate\Console\Command;
use Multimedia\Multistore\Support\File;
use Illuminate\Support\Str;

class ModulesAddHasing extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'modules:add.hasing';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new class in exists module';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
		$model = $this->ask('Model name:');
		$length = 64;
		$line = "\t'$model' => [
			'salt' => '".Str::random(64)."',
			'length' => $length,
			'alphabet' => 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890'
		],";

		(new File(config_path('hashids.php')))->findText("'connections' => [")->writeText($line);
    }
}
