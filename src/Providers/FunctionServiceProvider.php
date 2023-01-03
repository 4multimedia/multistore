<?php

namespace Multimedia\Multistore\Providers;

use Illuminate\Support\ServiceProvider;

class FunctionServiceProvider extends ServiceProvider {

    public function register() {

    }

    public function boot() {
        add_to_menu('dashboard', 'backend::dashboard.title', 'backend.dashboard', 0, ['icon' => 'home']);

		add_devider_menu(59);

		if (config('multimedia.modules.page')) {
			add_to_menu('page', 'backend::page.title', 'backend.page', 60, ['icon' => 'file-text']);
		}
		if (config('multimedia.modules.blog')) {
			add_to_menu('blog', 'backend::blog.title', null, 61, ['icon' => 'layout-list']);
			add_to_submenu('blog', 'backend::blog.list', 'backend.user');
			add_to_submenu('blog', 'backend::blog.categories', 'backend.user');
			add_to_submenu('blog', 'backend::blog.tags', 'backend.user');
			add_to_submenu('blog', 'backend::blog.comments', 'backend.user');
		}
		if (config('multimedia.modules.translate')) {
			add_to_menu('translate', 'backend::translate.title', null, 62, ['icon' => 'languages']);
		}
		if (config('multimedia.modules.content.popup') || config('multimedia.modules.content.slider')) {
			add_to_menu('content', 'backend::content.title', null, 63, ['icon' => 'layout-template']);
			if (config('multimedia.modules.content.popup')) {
				add_to_submenu('content', 'backend::content.popup', 'backend.user', 10);
			}
			if (config('multimedia.modules.content.slider')) {
				add_to_submenu('content', 'backend::content.slider', 'backend.user', 20);
			}
		}
		if (config('multimedia.modules.media')) {
			add_to_menu('media', 'backend::media.title', 'backend.media', 70, ['icon' => 'image']);
		}

		add_devider_menu(79);
		add_to_menu('user', 'backend::user.title', null, 80, ['icon' => 'users']);
        add_to_submenu('user', 'backend::user.list', 'backend.user');
        add_to_submenu('user', 'backend::user.create', 'backend.user.create');
        add_to_submenu('user', 'backend::user.group', 'backend.user.group');

		add_to_menu('setting', 'backend::setting.title', null, 90, ['icon' => 'settings']);
		if (config('multimedia.modules.blog')) {
			add_to_submenu('setting', 'backend::blog.title', 'backend.user', 20);
		}
		add_to_submenu('setting', 'backend::cookie.title', 'backend.user', 40);
		add_to_submenu('setting', 'backend::seo.title', 'backend.user', 30);
		add_to_submenu('setting', 'backend::redirect.title', 'backend.user', 31);
		add_to_submenu('setting', 'backend::task.title', 'backend.user', 50);
    }
}

