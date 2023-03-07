<?php

namespace Multimedia\Multistore\Providers;

use Illuminate\Support\ServiceProvider;
use Multimedia\Multistore\Classes\Hooks;
use Multimedia\Multistore\Classes\Backend;
use Multimedia\Multistore\Classes\Media;
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
		$this->app->bind('hooks', function($app) {
			return new Hooks();
		});

		$this->app->bind('modules', function ($app) {
			return $app->make(\Multimedia\Multistore\Classes\Modules::class);
		});

		$this->app->bind('plugins', function($app) {
			return new Plugins();
		});

        $this->app->bind('form', function($app) {
			return new Form();
		});

		$this->app->bind('menu', function($app) {
			return new Menu();
		});

        $this->app->bind('user_log', function($app) {
			return new UserLog();
		});

		$this->app->bind('backend', function($app) {
			return new Backend();
		});

		$this->app->bind('media', function($app) {
			return new Media();
		});

		$this->app->bind('table', function($app) {
			return new Tables();
		});

		$this->app->bind('domain', function($app) {
			return new Domain();
		});

		$this->app->bind('layout', function($app) {
			return new Layout();
		});

        $this->app->bind('page', function($app) {
			return new Page();
		});

        $this->app->bind('slug', function($app) {
			return new Slug();
		});
	}

	public function boot() {

	}
}

?>
