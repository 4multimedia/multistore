<?php

namespace Multimedia\Multistore\Commands;

use Illuminate\Console\Command;
use Multimedia\Multistore\Core\Models\UserRole;
use Str;

class ModulesCreateUserRole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'modules:userrole.create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new user role';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->ask('Please enter role name');

		UserRole::create(['name' => $name]);

		$this->info('Success! The role has been created');
		$this->line("Role: $name");
    }
}
