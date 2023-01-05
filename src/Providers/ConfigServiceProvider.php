<?php

namespace Multimedia\Multistore\Providers;

use Illuminate\Support\ServiceProvider;

class ConfigServiceProvider extends ServiceProvider {

	public function register() {

	}

	public function boot() {
		if ($this->app->runningInConsole()) {
			$this->publishes([__DIR__ . '/../config/multimedia.php' => config_path('multimedia.php')], 'multimedia');
			$this->publishes([__DIR__ . '/../public' => public_path()], 'multimedia');
			$this->publishes([__DIR__ . '/../Core/resources/lang/pl/validation.php' => base_path('lang/pl/validation.php')], 'multimedia');
		}

		$config_file = config_path('multimedia.php');

	}
}

?>
