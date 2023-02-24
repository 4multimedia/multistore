<?php

namespace Multimedia\Multistore\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class FunctionServiceProvider extends ServiceProvider {

    public function register() {

    }

    public function boot() {
        register_asset_style(__DIR__."/../Core/resources/css/form.css", true);
		register_asset_style(__DIR__."/../Core/resources/css/breadcrumbs.css", true);

		add_action('set_breadcrumbs', ['label' => 'Strona główna', 'route' => '/']);

		if (config('multimedia.assets.bootstrap')) {
			register_css('https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css', null, false, 20);
		}
        add_to_menu('dashboard', 'backend::dashboard.title', 'backend.dashboard', 0, ['icon' => 'home']);

		add_devider_menu(59);

        // uzytkownicy
        add_action('add_to_backend_navigation', [
            'label' => 'Profil',
            'items' => [
                ['id_record' => null, 'name' => 'Logowanie', 'module' => null, 'route' => 'profil.auth.login'],
                ['id_record' => null, 'name' => 'Rejestracja', 'module' => null, 'route' => 'profil.auth.register'],
                ['id_record' => null, 'name' => 'Odzyskaj hasło', 'module' => null, 'route' => 'profil.auth.reset'],
            ]
        ], 40);

		if (config('multimedia.modules.page')) {
			add_to_menu('page', 'backend::page.title', 'backend.page', 60, ['icon' => 'file-text']);

            if (Schema::hasTable('page')) {
                add_action('add_to_backend_navigation', [
                    'label' => 'Strony tekstowe',
                    'items' => set_navigation_items(page()->items(), 'Multimedia\Multistore\Core\Models\Page')
                ], 70);
            }
		}

        /** BLOG */
		if (config('multimedia.modules.blog')) {
			add_to_menu('blog', 'backend::blog.title', null, 61, ['icon' => 'layout-list']);
			add_to_submenu('blog', 'backend::blog.list', 'backend.user');
			add_to_submenu('blog', 'backend::blog.categories', 'backend.user');
			add_to_submenu('blog', 'backend::blog.tags', 'backend.user');
			add_to_submenu('blog', 'backend::blog.comments', 'backend.user');

            add_action('add_to_backend_navigation', [
                'label' => 'Artykuły',
                'items' => [
                    ['id_record' => null, 'name' => 'Wszystkie artykuły', 'label' => 'Artykuły', 'module' => null, 'route' => 'blog'],
                ]
            ], 80);
		}

		if (config('multimedia.modules.translate')) {
			add_to_menu('translate', 'backend::translate.title', null, 62, ['icon' => 'languages']);
		}
		if (config('multimedia.modules.content.popup') || config('multimedia.modules.content.slider')) {
			add_to_menu('content', 'backend::content.title', null, 63, ['icon' => 'layout-template']);
            if (config('multimedia.modules.content.navigation')) {
				add_to_submenu('content', 'backend::content.Navigation', 'backend.navigation', 5);
			}
			if (config('multimedia.modules.content.popup')) {
				add_to_submenu('content', 'backend::content.Popup', 'backend.user', 10);
			}
			if (config('multimedia.modules.content.slider')) {
				add_to_submenu('content', 'backend::content.Slider', 'backend.user', 20);
			}
		}
		if (config('multimedia.modules.media')) {
			add_to_menu('media', 'backend::media.Media', 'backend.media', 70, ['icon' => 'image']);
		}

		if (config('multimedia.modules.layout')) {
			add_to_menu('layout', 'backend::layout.Layout', null, 75, ['icon' => 'layout']);
			add_to_submenu('layout', 'backend::layout.All', 'backend.layout', 20);
			add_to_submenu('layout', 'backend::layout.Header', 'backend.layout', 20);
		}

		add_devider_menu(79);
		add_to_menu('user', 'backend::user.title', null, 80, ['icon' => 'users']);
        add_to_submenu('user', 'backend::user.list', 'backend.user');
        add_to_submenu('user', 'backend::user.create', 'backend.user.create');
        add_to_submenu('user', 'backend::user.group', 'backend.user.group');

		add_to_menu('stat', 'backend::stat.Stats', null, 90, ['icon' => 'bar-chart-3']);

		add_to_menu('setting', 'backend::setting.title', null, 90, ['icon' => 'settings']);
		if (config('multimedia.modules.blog')) {
			add_to_submenu('setting', 'backend::blog.title', 'backend.user', 20);
		}
		if (config('multimedia.modules.media') && config('multimedia.modules.setting.thumbnails')) {
			add_to_submenu('setting', 'backend::thumbnails.Thumbnails', 'backend.user', 25);
		}
        if (config('multimedia.modules.translate')) {
		    add_to_submenu('setting', 'backend::language.Language versions', 'backend.user', 30);
        }
		add_to_submenu('setting', 'backend::layout.Layout', 'backend.layout.setting.index', 35);
		add_to_submenu('setting', 'backend::setting.Domains', 'backend.setting.domain', 35);
		add_to_submenu('setting', 'backend::cookie.Cookies', 'backend.user', 40);
		add_to_submenu('setting', 'backend::seo.SEO', 'backend.user', 30);
		add_to_submenu('setting', 'backend::redirect.Redirects', 'backend.user', 31);
		add_to_submenu('setting', 'backend::task.Tasks', 'backend.user', 50);

        // MENU
        add_action('add_to_backend_navigation', [
            'label' => 'Pozostałe opcje',
            'items' => [
                ['id_record' => null, 'name' => 'Własny link', 'label' => 'Artykuły', 'module' => null, 'route' => null, 'component' => ''],
                ['id_record' => null, 'name' => 'Separator (devider)', 'label' => 'Separator (devider)', 'module' => null, 'route' => null, 'component' => ''],
                ['id_record' => null, 'name' => 'Tekst', 'label' => 'Separator (devider)', 'module' => null, 'route' => null, 'component' => ''],
            ]
        ], 80);
    }
}

