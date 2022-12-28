<?php

namespace Multimedia\Multistore\Providers;

use Illuminate\Support\ServiceProvider;

class FunctionServiceProvider extends ServiceProvider {

    public function register() {

    }

    public function boot() {
        add_to_menu('dashboard', 'backend::dashboard.title', 'backend.dashboard', 0, ['icon' => 'home']);
        add_devider_menu(69);
        add_to_menu('user', 'backend::user.title', null, 80, ['icon' => 'users']);
        add_to_submenu('user', 'backend::user.list', 'backend.user');
        add_to_submenu('user', 'backend::user.create', 'backend.user.create');
        add_to_submenu('user', 'backend::user.group', 'backend.user.group');
        add_to_menu('media', 'backend::media.title', null, 70, ['icon' => 'image']);
        add_to_menu('setting', 'backend::setting.title', null, 90, ['icon' => 'settings']);
    }
}
