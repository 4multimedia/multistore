<?php

    namespace App\Modules\Product\Providers;

	use Illuminate\Support\ServiceProvider;

	class AssetsServiceProvider extends ServiceProvider {
		public function boot() {
			register_css_path(dirname(__FILE__).'/../Resources/assets/css/');

			// register_css
		}
	}

?>
