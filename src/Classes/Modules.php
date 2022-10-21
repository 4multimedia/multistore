<?php

	namespace Multimedia\Multistore\Classes;

	use Illuminate\Support\Facades\File;

	class Modules {

		public function hasModule($module) {
			$find = false;

			$path = app_path('Modules');
			$dirs = File::directories($path);

			print_r($dirs);
		}
	}
