<?php

namespace Multimedia\Multistore\Providers;

use Illuminate\Support\ServiceProvider;
use Multimedia\Multistore\Classes\Hooks;
use Multimedia\Multistore\Classes\Backend;
use Multimedia\Multistore\Classes\Media;
use Multimedia\Multistore\Classes\Modules;
use Multimedia\Multistore\Classes\Plugins;
use Multimedia\Multistore\Classes\Form;
use Multimedia\Multistore\Classes\Menu;
use Multimedia\Multistore\Classes\UserLog;
use Multimedia\Multistore\Classes\Tables;
use Multimedia\Multistore\Classes\Domain;
use Multimedia\Multistore\Classes\Layout;
use Multimedia\Multistore\Classes\Page;
use Multimedia\Multistore\Classes\Slug;

class RegisterServiceProvider extends ServiceProvider {

	public function register() {
		$this->app->singleton('hooks', function($app) {
			return new Hooks();
		});

		$this->app->singleton('modules', function($app) {
			return $app->make(\Multimedia\Multistore\Classes\Modules::class);
		});

		$this->app->singleton('dictionary', function($app) {
			return $app->make(\Multimedia\Multistore\Classes\Dictionary::class);
		});

		$this->app->singleton('plugins', function($app) {
			return new Plugins();
		});

        $this->app->singleton('form', function($app) {
			return new Form();
		});

		$this->app->singleton('menu', function($app) {
			return new Menu();
		});

        $this->app->singleton('user_log', function($app) {
			return new UserLog();
		});

		$this->app->singleton('backend', function($app) {
			return new Backend();
		});

		$this->app->singleton('media', function($app) {
			return new Media();
		});

		$this->app->singleton('table', function($app) {
			return new Tables();
		});

		$this->app->singleton('domain', function($app) {
			return new Domain();
		});

		$this->app->singleton('layout', function($app) {
			return new Layout();
		});

        $this->app->singleton('page', function($app) {
			return new Page();
		});

        $this->app->singleton('slug', function($app) {
			return new Slug();
		});
	}

	public function boot() {

	}
}

?>
