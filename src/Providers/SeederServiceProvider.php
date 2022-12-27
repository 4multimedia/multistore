<?php

namespace Multimedia\Multistore\Providers;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Support\ServiceProvider;

class SeederServiceProvider extends ServiceProvider {

    public $seeders = [
        'Multimedia\Multistore\Core\Database\Seeders\UserRoleSeeder',
        'Multimedia\Multistore\Core\Database\Seeders\UserStatusSeeder',
    ];

    public function register() {

    }

    public function boot() {
        $seeders = $this->seeders;
        $this->callAfterResolving(DatabaseSeeder::class, function ($seeder) use ($seeders) {
            foreach ((array) $seeders as $path) {
				echo $path;
                $seeder->call($path);
            }
        });
    }
}
