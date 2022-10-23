<?php

namespace Multimedia\Multistore\Providers;

use Illuminate\Support\ServiceProvider;

class MigrationServiceProvider extends ServiceProvider {

    public function boot() {
        $this->loadMigrationsFrom(__DIR__."/../Core/Database/Migrations");
    }
}
