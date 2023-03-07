<?php

namespace Multimedia\Multistore\Providers;

use Illuminate\Support\ServiceProvider;
use Multimedia\Multistore\Classes\Hooks;
use Str;

class AssetsServiceProvider extends ServiceProvider {

	public function register() {

	}

	public function boot() {
		$this->app->singleton('hooks', function($app) {
			return new Hooks();
		});

		generate_css_variables();
		generate_css_from_layout();
	}
}

?>
