<?php

namespace Multimedia\Multistore\Providers;

use Illuminate\Support\ServiceProvider;

class FunctionServiceProvider extends ServiceProvider {

    public function register() {

    }

    public function boot() {
        add_to_menu('dashboard', 'backend::dashboard.title', 'backend.dashboard');
        add_to_menu('user', 'backend::user.title', null, 20);
        add_to_submenu('user', 'backend::user.create', 'backend.user.create');
    }
}
