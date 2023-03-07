<?php

	namespace Multimedia\Multistore\Classes;

	use Illuminate\Support\Facades\File;

	class Modules {
		public $modules = [];

		public function get_modules() {
			$find = false;

			$path = app_path('Modules');
			$dirs = File::directories($path);

			foreach($dirs as $dir) {
				$module = explode("/", $dir);
				$array[] = $module[count($module)-1];
			}

			asort($array);

			return $array;
		}

		public function register($module) {
			if (!in_array($module, $this->modules)) {
				$this->modules[] = $module;
			}
		}
	}
