<?php

namespace Multimedia\Multistore\Providers;

use Illuminate\Support\ServiceProvider;
use Multimedia\Multistore\Classes\Backend;
use Multimedia\Multistore\Classes\Modules;
use Multimedia\Multistore\Classes\Plugins;
use Multimedia\Multistore\Classes\Form;
use Multimedia\Multistore\Classes\Menu;
use Multimedia\Multistore\Classes\UserLog;

class RegisterServiceProvider extends ServiceProvider {

	public function register() {
		$this->app->singleton('modules', function($app) {
			return new Modules();
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
	}

	public function boot() {

	}
}

?>
