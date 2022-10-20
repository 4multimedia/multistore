<?php

    namespace Multimedia\Multistore\Support;

    use Multimedia\Multistore\Support\Stub;

    class Creating {

        public $module;

        public function __construct($module)
        {
            $this->module = $module;
        }

        public function createDirs() {

            $dirs = ['Commands', 'Providers', 'Models', 'Controllers', 'routes'];

            $dirs = [
                'Config',
                'Console',
                'Database' => [
                    'Migration',
                    'Seeders'
                ],
                'Http' => [
                    'Controllers',
                    'Middleware',
                    'Request'
                ],
                'Providers',
                'Resources' => [
                    'assets',
                    'lang'
                ],
                'routes'
            ];

            foreach($dirs as $key => $dir) {
                @mkdir(app_path('Modules'));
                @mkdir(app_path("Modules/".$this->module));
                @mkdir(app_path('Extended'));
                @mkdir(app_path('Extended/Modules'));
                @mkdir(app_path("Extended/Modules/".$this->module));

                if (is_array($dir)) {
                    @mkdir(app_path("Modules/".$this->module."/".$key));
                    @mkdir(app_path("Extended/Modules/".$this->module."/".$key));

                    foreach($dir as $subkey) {
                        @mkdir(app_path("Modules/".$this->module."/".$key."/".$subkey));
                        @mkdir(app_path("Extended/Modules/".$this->module."/".$key."/".$subkey));
                    }
                } else {
                    @mkdir(app_path("Modules/".$this->module."/".$dir));
                    @mkdir(app_path("Extended/Modules/".$this->module."/".$dir));
                }
            }
        }

        public function createProviderFiles() {
            $array = [];
            $returned = [];

            $array['module'] = $this->module;
            $array['class'] = $this->module.'Service';

            $returned['module'] = (new Stub('providers/module', 'Providers', array_merge($array, ['class' => $this->module.'Service'])))->save();
            $returned['command'] = (new Stub('providers/command', 'Providers', array_merge($array, ['class' => 'CommandsService'])))->save();
            $returned['route'] = (new Stub('providers/route', 'Providers', array_merge($array, ['class' => 'RouteService'])))->save();
            $returned['assets'] = (new Stub('providers/assets', 'Providers', array_merge($array, ['class' => 'AssetsService'])))->save();

            $returned['module'] = (new Stub('providers/module', 'Providers', array_merge($array, ['extended' => true, 'class' => $this->module.'Service'])))->save();
            $returned['command'] = (new Stub('providers/command', 'Providers', array_merge($array, ['extended' => true, 'class' => 'CommandsService'])))->save();
            $returned['route'] = (new Stub('providers/route', 'Providers', array_merge($array, ['extended' => true, 'class' => 'RouteService'])))->save();
			$returned['assets'] = (new Stub('providers/assets', 'Providers', array_merge($array, ['extended' => true, 'class' => 'AssetsService'])))->save();

            (new Stub('routes/web', null, $array))->copy('routes/web');
            (new Stub('routes/api', null, $array))->copy('routes/api');
            (new Stub('routes/backend', null, $array))->copy('routes/backend');
            (new Stub('functions', null, $array))->copy('');

            (new Stub('routes/web', null, array_merge($array, ['extended' => true])))->copy('routes/web');
            (new Stub('routes/api', null, array_merge($array, ['extended' => true])))->copy('routes/api');
            (new Stub('routes/backend', null, array_merge($array, ['extended' => true])))->copy('routes/backend');
        }

        public function generate() {
            $this->createDirs();
            $this->createProviderFiles();
        }
    }
