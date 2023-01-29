<?php

namespace Multimedia\Multistore\Providers;

use Illuminate\Support\ServiceProvider;

class ModuleFunctionServiceProvider extends ServiceProvider {

    public function register() {

    }

    public function boot() {
        add_action('register_to_navigation', 'Multimedia\Multistore\Core\Http\Classes\Page@list', 20, 1);
        add_action('register_to_navigation', 'Multimedia\Multistore\Core\Http\Classes\Page@list', 20, 1);
    }
}
