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
                    $provider = "\\App\\Modules\\$dir\\Providers\\{$dir}ServiceProvider";
                    $this->app->register($provider);
                }

                $dirs = array_diff(scandir(app_path('Extended/Modules')), array('..', '.'));
                foreach($dirs as $dir) {
                    $provider = "\\App\\Extended\\Modules\\$dir\\Providers\\{$dir}ServiceProvider";
                    $this->app->register($provider);
                }
            }
        }
    }
