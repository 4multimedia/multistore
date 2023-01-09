<?php

    namespace App\Modules\Product\Providers;

	use Illuminate\Support\ServiceProvider;

	class FunctionServiceProvider extends ServiceProvider {
        public const CONTROLLERS = 'App\Modules\Product\Http\Controllers\Backend';

		public function boot() {
			add_to_menu('module.product', __('module.product::core.Assortment'), null, 20, ['icon' => 'package']);
			add_to_submenu('module.product', __('module.product::core.Products'), 'backend.product');
			add_to_submenu('module.product', __('module.product::core.Categories'), 'backend.product.category');
			add_to_submenu('module.product', __('module.product::core.Producers'), 'backend.product.producer');

            add_action('dashbord_widget', static::CONTROLLERS.'\WidgetController@chart', 20);
		}
	}

?>
