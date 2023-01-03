<?php

    namespace App\Modules\Product\Providers;

    use Illuminate\Support\ServiceProvider;

    class CommandsServiceProvider extends ServiceProvider {
        public function boot() {

            $commands = [];
            $files = array_diff(scandir(app_path('Modules/Product/Console')), array('..', '.'));
            foreach($files as $file) {
                $filePath = strtr($file, ['.php' => '']);

                $commands[] = "App\\Modules\\Product\\Console\\$filePath";
            }

            $this->commands($commands);
        }
    }
