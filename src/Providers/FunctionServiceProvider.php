<?php

namespace Multimedia\Multistore\Providers;

use Illuminate\Support\ServiceProvider;

class FunctionServiceProvider extends ServiceProvider {

    public function register() {

    }

    public function boot() {
        add_to_menu('dashboard', 'backend::dashboard.title', 'backend.dashboard', 0, ['icon' => 'home']);

		add_devider_menu(59);

		add_to_menu('page', 'backend::page.title', null, 60, ['icon' => 'file-text']);
		add_to_menu('blog', 'backend::blog.title', null, 61, ['icon' => 'layout-list']);
		add_to_submenu('blog', 'backend::blog.list', 'backend.user');
		add_to_submenu('blog', 'backend::blog.categories', 'backend.user');
		add_to_submenu('blog', 'backend::blog.tags', 'backend.user');
		add_to_submenu('blog', 'backend::blog.comments', 'backend.user');
		add_to_menu('translate', 'backend::translate.title', null, 62, ['icon' => 'languages']);
		add_to_menu('content', 'backend::content.title', null, 63, ['icon' => 'layout-template']);

		add_devider_menu(69);
		add_to_menu('media', 'backend::media.title', null, 70, ['icon' => 'image']);
		add_to_menu('user', 'backend::user.title', null, 80, ['icon' => 'users']);
        add_to_submenu('user', 'backend::user.list', 'backend.user');
        add_to_submenu('user', 'backend::user.create', 'backend.user.create');
        add_to_submenu('user', 'backend::user.group', 'backend.user.group');

		add_to_menu('setting', 'backend::setting.title', null, 90, ['icon' => 'settings']);
		add_to_submenu('setting', 'backend::blog.title', 'backend.user', 20);
		add_to_submenu('cookie', 'backend::cookie.title', 'backend.user', 20);
    }
}

