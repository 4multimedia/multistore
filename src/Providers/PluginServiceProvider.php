<?php

namespace Multimedia\Multistore\Providers;

use Illuminate\Support\ServiceProvider;

class PluginServiceProvider extends ServiceProvider {

	public function register() {
		$this->mergeConfigFrom(__DIR__.'/../config/plugin.php', 'plugins');

		$this->loadPluginServiceProvider();
	}

	public function boot() {
		// $this->app->register(BootstrapServiceProvider::class);
	}

	public function loadPluginServiceProvider() {
		if (is_dir(app_path('Plugins'))) {
			$dirs = array_diff(scandir(app_path('Plugins')), array('..', '.', '.DS_Store'));
			foreach($dirs as $dir) {
				$providers = array_diff(scandir(app_path('Plugins/'.$dir.'/Providers')), array('..', '.'));

				foreach($providers as $providerFile) {
					$providerFile = strtr($providerFile, ['.php' => '']);

					$provider = "\\App\\Plugins\\$dir\\Providers\\{$providerFile}";
					$this->app->register($provider);
				}
			}
		}
	}
}

?>
