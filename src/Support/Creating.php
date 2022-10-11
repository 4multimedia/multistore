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

            @mkdir(app_path('Modules'));
            @mkdir(app_path("Modules/".$this->module));
            @mkdir(app_path('Extended'));
            @mkdir(app_path('Extended/Modules'));
            @mkdir(app_path("Extended/Modules/".$this->module));

            foreach($dirs as $dir) {
                @mkdir(app_path("Modules/".$this->module."/".$dir));
                @mkdir(app_path("Extended/Modules/".$this->module."/".$dir));
            }
        }

        public function createProviderFiles() {
            $array = [];
            $returned = [];

            $array['module'] = $this->module;
            $array['class'] = $this->module.'Service';

            $returned['module'] = (new Stub('providers/module', 'Provider', array_merge($array, ['class' => $this->module.'Service'])))->save();
            $returned['command'] = (new Stub('providers/command', 'Provider', array_merge($array, ['class' => 'CommandsService'])))->save();
            $returned['route'] = (new Stub('providers/route', 'Provider', array_merge($array, ['class' => 'RouteService'])))->save();

            $returned['module'] = (new Stub('providers/module', 'Provider', array_merge($array, ['extended' => true, 'class' => $this->module.'Service'])))->save();
            $returned['command'] = (new Stub('providers/command', 'Provider', array_merge($array, ['extended' => true, 'class' => 'CommandsService'])))->save();
            $returned['route'] = (new Stub('providers/route', 'Provider', array_merge($array, ['extended' => true, 'class' => 'RouteService'])))->save();

            (new Stub('routes/web', null, $array))->copy('routes/web');
            (new Stub('routes/api', null, $array))->copy('routes/api');

            (new Stub('routes/web', null, array_merge($array, ['extended' => true])))->copy('routes/web');
            (new Stub('routes/api', null, array_merge($array, ['extended' => true])))->copy('routes/api');
        }

        public function generate() {
            $this->createDirs();
            $this->createProviderFiles();
        }
    }
