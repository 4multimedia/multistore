<?php

namespace Multimedia\Multistore\Providers;

use Illuminate\Support\Facades\File;
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

        $configuration = config('multimedia');
        $configuration = json_encode($configuration, JSON_PRETTY_PRINT);
        @mkdir(__DIR__ . '/../data');
        @mkdir(__DIR__ . '/../data/json');
        file_put_contents(__DIR__ . '/../data/json/config.json', $configuration);
	}
}

?>
