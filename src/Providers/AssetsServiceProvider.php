<?php

namespace Multimedia\Multistore\Providers;

use Illuminate\Support\ServiceProvider;
use Multimedia\Multistore\Classes\Hooks;

class AssetsServiceProvider extends ServiceProvider {

	public function register() {
		$this->app->singleton('hooks', function($app) {
			return new Hooks();
		});
	}

	public function boot() {

	}
}

?>
