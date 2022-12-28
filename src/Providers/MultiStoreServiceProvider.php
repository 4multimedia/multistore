<?php

    namespace Multimedia\Multistore\Providers;

	use Illuminate\Support\ServiceProvider;

    class MultiStoreServiceProvider extends ServiceProvider {

        public function boot() {
            $this->loadViewsFrom(dirname(__FILE__).'/../core/resources/views', 'backend');
            $this->loadViewsFrom(dirname(__FILE__).'/../core/resources/components', 'components');
			$this->loadTranslationsFrom(dirname(__FILE__).'/../core/resources/lang', 'backend');
        }

        public function register()
        {
			$this->app->register(AssetsServiceProvider::class);
            $this->app->register(ConsoleServiceProvider::class);
            $this->app->register(RouteServiceProvider::class);
            $this->app->register(MiddlewareServiceProvider::class);
            $this->app->register(DirectiveServiceProvider::class);
			$this->app->register(RegisterServiceProvider::class);
			$this->app->register(MigrationServiceProvider::class);
            $this->app->register(SeederServiceProvider::class);
            $this->app->register(FunctionServiceProvider::class);

            $this->loadModuleServiceProvider();
        }

        public function loadModuleServiceProvider() {
            if (is_dir(app_path('Modules'))) {
                $dirs = array_diff(scandir(app_path('Modules')), array('..', '.'));
                foreach($dirs as $dir) {
                    $providers = array_diff(scandir(app_path('Modules/'.$dir.'/Providers')), array('..', '.'));

                    foreach($providers as $providerFile) {
                        $providerFile = strtr($providerFile, ['.php' => '']);

                        $provider = "\\App\\Modules\\$dir\\Providers\\{$providerFile}";
                        $this->app->register($provider);
                    }
                }
            }

            if (is_dir(app_path('Extended/Modules'))) {
                $dirs = array_diff(scandir(app_path('Extended/Modules')), array('..', '.'));
                foreach($dirs as $dir) {
                    $providers = array_diff(scandir(app_path('Extended/Modules/'.$dir.'/Providers')), array('..', '.'));

                    foreach($providers as $providerFile) {
                        $providerFile = strtr($providerFile, ['.php' => '']);

                        $provider = "\\App\\Extended\\Modules\\$dir\\Providers\\{$providerFile}";
                        $this->app->register($provider);
                    }
                }
            }
        }
    }
