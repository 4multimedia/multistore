<?php

    namespace Multimedia\Multistore\Providers;

    use Illuminate\Support\ServiceProvider;

    class MultiStoreServiceProvider extends ServiceProvider {

        public function register()
        {
            $this->app->register(ConsoleServiceProvider::class);

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
