<?php

namespace Multimedia\Multistore\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Multimedia\Multistore\Support\Stub;

class ModulesInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'modules:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install modules';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
		// instalacja
		$this->info('Install database table');
		$this->call('migrate:fresh');
		$this->info('Run seeder');
		$this->call('db:seed', ['--class' => 'Multimedia\Multistore\Core\Database\Seeders\UserRoleSeeder']);
		$this->call('db:seed', ['--class' => 'Multimedia\Multistore\Core\Database\Seeders\UserStatusSeeder']);
		$this->info('Copy vendor');
		$this->call("vendor:publish", ['--tag' => 'multimedia', '--force' => true]);
		$this->call("vendor:publish", ["--provider" => 'Vinkla\Hashids\HashidsServiceProvider']);
        $domain = $this->ask('Enter domain');
        add_domain($domain);
        save_option('meta.title', $domain, true, true);
        save_option('setting.language', ['languages' => ['pl' => 1], 'default' => 'pl'], true, true);

        add_hashids(['Article', 'ArticleCategory', 'Dictionary', 'DictionaryRelative', 'Layout', 'MediaDirectory', 'MediaFiles', 'Navigation', 'OptionDomain', 'Page', 'Seo', 'User', 'UserRole']);

        $this->info('Install complete!');
    }
}
