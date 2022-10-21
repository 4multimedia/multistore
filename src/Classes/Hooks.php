<?php

	namespace Multimedia\Multistore\Classes;

	use Illuminate\Support\Facades\File;

	class Hooks {

		public $css;
		public $assetsPath;

		public function __construct()
		{
			$this->css = [];
		}

		/* HOOKS StyleSheets */
		public function register_css($path, $place) {
			$this->css[] = $this->assetsPath.$path.".css";
		}

		public function register_css_path($path) {
			$this->assetsPath = $path;
		}

		public function get_css() {
			$cssWebLocation = public_path('assets/css/web.css');
			$cssWebPut = false;
			$cssWebFileDate = 0;

			if (file_exists($cssWebLocation)) {
				$cssWebFileDate = filemtime($cssWebLocation);
			}

			$cssContent = '';
			foreach($this->css as $file) {
				if(file_exists($file)) {
					$cssContent .= File::get($file);
					$cssFileDate = filemtime($file);
					if ($cssFileDate > $cssWebFileDate) {
						$cssWebPut = true;
					}
				}
			}

			if ($cssWebPut) {
				@mkdir(public_path('assets'));
				@mkdir(public_path('assets/css'));
				file_put_contents(public_path('assets/css/web.css'), $cssContent);
			}

			echo '<link rel="stylesheet" href="/assets/css/web.css">';
		}
	}
