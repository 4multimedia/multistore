<?php

    namespace App\Modules\Product\Providers;

    use Illuminate\Support\ServiceProvider;

    class ProductServiceProvider extends ServiceProvider {
        public function boot()
        {
			$this->loadTranslationsFrom(dirname(__FILE__).'/../Resources/lang', 'module.product');
			$this->loadViewsFrom(dirname(__FILE__).'/../Resources/views/backend', 'module.product.backend');
        }

        public function register()
        {
            $this->app->register(CommandsServiceProvider::class);
        }
    }
