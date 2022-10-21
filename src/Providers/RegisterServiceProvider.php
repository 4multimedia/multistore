<?php

namespace Multimedia\Multistore\Providers;

use Illuminate\Support\ServiceProvider;
use Multimedia\Multistore\Classes\Modules;
use Multimedia\Multistore\Classes\Plugins;

class RegisterServiceProvider extends ServiceProvider {

	public function register() {
		$this->app->singleton('modules', function($app) {
			return new Modules();
		});

		$this->app->singleton('plugins', function($app) {
			return new Plugins();
		});
	}

	public function boot() {

	}
}

?>
