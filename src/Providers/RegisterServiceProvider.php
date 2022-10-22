<?php

namespace Multimedia\Multistore\Providers;

use Illuminate\Support\ServiceProvider;
use Multimedia\Multistore\Classes\Modules;
use Multimedia\Multistore\Classes\Plugins;
use Multimedia\Multistore\Classes\Form;

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
	}

	public function boot() {

	}
}

?>
