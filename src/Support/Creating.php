<?php

    namespace Multimedia\Multistore\Support;

    use Multimedia\Multistore\Support\Stub;
    use Illuminate\Support\Arr;

    class Creating {

        public $module;
		public $languages = [];

        public function __construct($module)
        {
            $this->module = $module;
			$this->languages = ['pl', 'en', 'de'];
        }

        public function createDirs() {
            $dirs = [
                'Modules' => [
                    $this->module => [
                        'Config',
                        'Console',
                        'Database' => [
                            'Migration',
                            'Seeders'
                        ],
                        'Http' => [
							'Classes',
                            'Controllers' => [
								'Api',
                                'Frontend',
                                'Backend',
                            ],
                            'Middleware',
                            'Request',
                            'Models'
                        ],
                        'Providers',
                        'Resources' => [
                            'assets',
                            'lang',
							'views' => [
								'backend',
								'frontend'
							]
                        ],
                        'routes'
                    ]
                ]
            ];

			$dirs["Modules"][$this->module]["Resources"]["lang"] = $this->languages;

            $flattened = Arr::dot($dirs);

            $array_dirs = [];
            foreach($flattened as $key => $item) {
                $dirs = explode(".", $key);
                $dirs[count($dirs)-1] = $item;

                $path = [];
                foreach($dirs as $dir) {
                    $path[] = $dir;
                    $path_extended[] = $dir;
                    $dir = implode('/', $path);
                    $array_dirs[$dir] = true;
                }
            }

            foreach($array_dirs as $dir => $status) {
                $dir = explode("/", $dir);
                $path = [];
                foreach($dir as $dir_name) {
                    $path[] = $dir_name;
                    $dir_path = implode("/", $path);
                    @mkdir(app_path($dir_path));
                    @mkdir(app_path('Extended/'.$dir_path));
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
            $returned['migration'] = (new Stub('providers/migration', 'Providers', array_merge($array, ['class' => 'MigrationService'])))->save();
            $returned['function'] = (new Stub('providers/function', 'Providers', array_merge($array, ['class' => 'FunctionService'])))->save();

            $returned['module'] = (new Stub('providers/module', 'Providers', array_merge($array, ['extended' => true, 'class' => $this->module.'Service'])))->save();
            $returned['command'] = (new Stub('providers/command', 'Providers', array_merge($array, ['extended' => true, 'class' => 'CommandsService'])))->save();
            $returned['route'] = (new Stub('providers/route', 'Providers', array_merge($array, ['extended' => true, 'class' => 'RouteService'])))->save();
			$returned['assets'] = (new Stub('providers/assets', 'Providers', array_merge($array, ['extended' => true, 'class' => 'AssetsService'])))->save();
			$returned['migration'] = (new Stub('providers/migration', 'Providers', array_merge($array, ['extended' => true, 'class' => 'MigrationService'])))->save();
			$returned['function'] = (new Stub('providers/function', 'Providers', array_merge($array, ['extended' => true, 'class' => 'FunctionService'])))->save();

            (new Stub('routes/web', null, $array))->copy('routes/web');
            (new Stub('routes/api', null, $array))->copy('routes/api');
            (new Stub('routes/backend', null, $array))->copy('routes/backend');
            (new Stub('functions', null, $array))->copy('');

            (new Stub('routes/web', null, array_merge($array, ['extended' => true])))->copy('routes/web');
            (new Stub('routes/api', null, array_merge($array, ['extended' => true])))->copy('routes/api');
            (new Stub('routes/backend', null, array_merge($array, ['extended' => true])))->copy('routes/backend');

			foreach($this->languages as $lang) {
				(new Stub('lang/lang', null, $array))->copy(null, 'Resources/lang/'.$lang.'/core');
				(new Stub('lang/lang', null, array_merge($array, ['extended' => true])))->copy(null, 'Resources/lang/'.$lang.'/core');
			}
        }

        public function generate() {
            $this->createDirs();
            $this->createProviderFiles();
        }
    }
