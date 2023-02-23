<?php

	namespace Multimedia\Multistore\Classes;

	use Illuminate\Support\Facades\File;

	class Hooks {

		public $css;
		public $assetsPath;
        public $filters = [];
        protected $merged_filters = [];
        protected $actions = [];
        public $current_filter = [];
		public $title = '';
		public $meta_title = '';
        public $button_header = [];
		public $assets_js = [];

		public function __construct()
		{
			$this->css = [];
            $this->filters = [];
            $this->merged_filters = [];
            $this->actions = [];
            $this->current_filter = [];
			$this->assets_js = ['before' => [], 'after' => []];
		}

		public function calling_function_name($level) {
			$ex = new \Exception();
			$trace = $ex->getTrace();
			return $trace[$level];
		}

		public function set_asset_path($dir) {
			$trace = $this->calling_function_name(3);
			$file = $trace["file"];
			preg_match('/(.*)\/Modules\/([A-Za-z]+)\/(.*)/', $file, $output_array);
			$path = $output_array[1]."/Modules/".$output_array[2]."/Resources/assets/".$dir."/";
			$this->assetsPath = $path;
		}

		/* HOOKS Header */
		public function get_header() {
			echo '<head>
		<title>'.get_meta_title().'</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">'.get_meta_all_tags().'
		'.get_css().'
	</head>';
		}

		/* HOOKS StyleSheets */
		public function register_css($path, $place, $merge, $priority = 50) {
			if (strpos($path, "/") === false) {
				$this->set_asset_path('css');
			}
			if (substr($path, strlen($path) - 4, strlen($path)) !== ".css") {
				$path = $path.".css";
			}
			$this->css[$priority][] = [
				'path' => $this->assetsPath.$path,
				'place' => $place,
				'merge' => $merge
			];
		}

		public function register_css_path($path) {
			$this->css[50][] = [
				'path' => $path,
				'place' => 'all',
				'merge' => false
			];
		}

		public function register_asset_style($path, $merge = false) {
			if (file_exists($path)) {
				$file_name = explode("/", $path);
				$file_name = $file_name[count($file_name)-1];
				$to = public_path('css/'.$file_name);
				copy($path, $to);
                if ($merge) {
                    register_css(public_path('/css/'.$file_name), 'all', $merge);
                } else {
				    register_css('/css/'.$file_name, 'all', $merge);
                }
			}
		}

		public function get_css($params = []) {
			$external = [];
			$cssWebLocation = public_path('assets/css/web.css');
			$cssWebPut = false;
			$cssWebFileDate = 0;

            @mkdir(public_path('assets'));
            @mkdir(public_path('assets/css'));

			$tabs = 2;
			if (isset($params["tabs"])) { $tabs = $params["tabs"]; }

			if (file_exists($cssWebLocation)) {
				$cssWebFileDate = filemtime($cssWebLocation);
			} else {
				file_put_contents(public_path('assets/css/web.css'), '');
			}



			$css = [];
			ksort($this->css);
			foreach($this->css as $css_item) {
				foreach($css_item as $item) {
					$css[] = $item;
				}
			}

			if (!file_exists(public_path('assets/css/web.css'))) {
				@mkdir(public_path('assets'));
				@mkdir(public_path('assets/css'));
				file_put_contents(public_path('assets/css/web.css'), '');
			}

			$cssContent = '';
			foreach($css as $item) {
				$file = $item["path"];
                if (substr($file, 0, 4) === 'http' || $item["merge"] === false) {
                    $external[] = $file;
                } else {
                    if(is_file($file) && file_exists($file)) {
                        $cssContent .= File::get($file);
                        $cssFileDate = filemtime($file);
                        if ($cssFileDate > $cssWebFileDate) {
                            $cssWebPut = true;
                        }
                    }
                }
			}

			$external[] = asset('assets/css/web.css');

			if ($cssWebPut) {
				// $cssContent = preg_replace(array('/\s*(\w)\s*{\s*/','/\s*(\S*:)(\s*)([^;]*)(\s|\n)*;(\n|\s)*/','/\n/','/\s*}\s*/'), array('$1{ ','$1$3;',"",'} '), $cssContent);
				file_put_contents(public_path('assets/css/web.css'), $cssContent);
			}

			$response = "";
			if ($external) {
				foreach($external as $file) {
					$response .= "\n";
					$response .= str_repeat("\t", $tabs);
					$response .= "<link rel=\"stylesheet\" href=\"$file\">";
				}
			}
			return $response;
		}

		/* HOOKS JavaScript */
		public function register_assets_js_path($path, $position = 'after') {
			if (!in_array($path, $this->assets_js[$position])) {
				$this->assets_js[$position][] = $path;
			}
		}

		public function register_assets_code() {

		}

		public function get_assets_backend_js($position = 'after') {
			foreach($this->assets_js[$position] as $path) {
				echo "\n\t\t<script src=\"".asset($path)."\" referrerpolicy=\"origin\"></script>";
			}
		}

		public function get_assets_frontend_js($position = 'after') {
			foreach($this->assets_js[$position] as $path) {
				echo "\n\t\t<script src=\"".asset($path)."\" referrerpolicy=\"origin\"></script>";
			}
		}

		/* HOOKS Title */
		public function set_title($title) {
			$this->title = $title;
		}

		public function get_title() {
			return $this->title;
		}

        /* HOOKS Action Buttons */
        public function add_button_header($label, $route, $color) {
            $this->button_header[] = [
                "label" => $label,
                "route" => $route
            ];
        }

        public function get_action_header() {
            $buttons = [];
            foreach($this->button_header as $button) {
                $buttons[] = '<a href="'.$button["route"].'" class="btn btn-primary shadow-md ml-2">'.$button["label"].'</a>';
            }
            return implode(" ", $buttons);
        }

		/* HOOKS Meta */
		public function set_meta_title($title) {
			$this->meta_title = $title;
		}

		public function get_meta_title($title = '') {
			$array = [];
			if ($this->meta_title) { $array[] = $this->meta_title; }
			if (!$this->meta_title && $this->title) { $array[] = $this->title; }
			if ($title) { $array[] = $title; }
			return implode(" | ", $array);
		}

        /* General */
        private function hookUniqueId($tag, $function, $priority) {
            static $filter_id_count = 0;
            if ( is_string($function)) {
                return $function;
            }

            if (is_object($function)) {
                $function = array( $function, '' );
            } else {
                $function = (array) $function;
            }

            if (is_object($function[0])) {
                if (function_exists('spl_object_hash')) {
                    return spl_object_hash($function[0]) . $function[1];
                } else {
                    $obj_idx = get_class($function[0]).$function[1];
                    if (!isset($function[0]->filter_id)) {
                        if (false === $priority) {
                            return false;
                        }
                        $obj_idx .= isset($this->filters[$tag][$priority]) ? count((array)$this->filters[$tag][$priority]) : $filter_id_count;
                        $function[0]->filter_id = $filter_id_count;
                        ++$filter_id_count;
                    } else {
                        $obj_idx .= $function[0]->filter_id;
                    }

                    return $obj_idx;
                }
			} else if (is_string($function[0]) AND !isset($function[1])) {
                return $function[0];
            } else if (is_string($function[0])) {
                return $function[0].$function[1];
            }
        }

        public function callAllHooks($args) {
            reset( $this->filters['all'] );
            do {
                foreach((array) current($this->filters['all']) as $theCurrent) {
                    if (!is_null($theCurrent['function'])) {
                        call_user_func_array($theCurrent['function'], $args);
                    }
                }
            } while (next($this->filters['all']) !== false);
        }

        /* Filters */
        public function add_filter($tag, $callback, $priority = 10, $accepted_args = 1) {
            $idx =  $this->hookUniqueId($tag, $callback, $priority);
            $this->filters[$tag][$priority][$idx] = ['function' => $callback, 'accepted_args' => $accepted_args];
            unset($this->merged_filters[$tag]);
            return true;
        }

        /* Actions */
        public function add_action($tag, $callback, $priority = 10, $accepted_args = 1) {
            return $this->add_filter($tag, $callback, $priority, $accepted_args);
        }

		public function do_action($tag, $arg) {
			$callback = [];
			if (isset($this->actions[$tag])) {
				$type = $this->actions[$tag]["type"];
				unset($this->actions[$tag]["type"]);
				ksort($this->actions[$tag]);
				foreach($this->actions[$tag] as $key => $values) {
					foreach ($values as $subkey => $value) {
						if ($type === "string") {
							$function_name = $value["callable"];
							$args = $value["args"];
							$callback[] = call_user_func_array($function_name, $args);
						} else if ($type === 'array') {
                            $arrays_value = $value["callable"];
                            $callback[] = $arrays_value;
                        }
					}
				}
				$this->actions[$tag]["type"] = $type;
				return $callback;
			}
			return ;
		}

        public function do_action_($tag, $arg = '') {
            if (!isset($this->actions)) {
                $this->actions = array();
            }

            if (!isset($this->actions[$tag])) {
                $this->actions[$tag] = 1;
            } else {
                ++$this->actions[$tag];
            }

            if (isset($this->filters['all'])) {
                $this->current_filter[] = $tag;
                $all_args = func_get_args();
                $this->callAllHooks($all_args);
            }

            if (!isset($this->filters[$tag])) {
                if (isset($this->filters['all'])) {
                    array_pop($this->current_filter);
                }
                return;
            }

            if (!isset($this->filters['all'])) {
                $this->current_filter[] = $tag;
            }

            $args = [];
            if (is_array($arg) && 1 == count($arg) && isset($arg[0]) && is_object($arg[0])) {
                $args[] =& $arg[0];
            } else {
                $args[] = $arg;
            }

            for ($index = 2; $index < func_num_args(); $index++) {
                $args[] = func_get_arg($index);
            }

            if (!isset( $this->merged_filters[$tag])) {
                ksort($this->filters[$tag]);
                $this->merged_filters[$tag] = true;
            }

            reset($this->filters[$tag]);

            do {
                foreach ( (array) current($this->filters[$tag]) as $the_ ) {
                    if ( !is_null($the_['function'])) {
						print_r($the_);
                        call_user_func_array($the_['function'], array_slice($args, 0, (int) $the_['accepted_args']));
                    }
                }
            } while (next($this->filters[$tag]) !== false);

            array_pop($this->current_filter);
        }

		function getHookCallback($callback) {
			if (is_string($callback) && strpos($callback, '@')) {
				$callback = explode('@', $callback);
				return [app('\\'.$callback[0]), $callback[1]];
			}

			if (is_string($callback) && function_exists($callback)) {
				return $callback;
			}

			if (is_string($callback)) {
				return [app('\\'.$callback), 'handle'];
			}

			if (is_callable($callback)) {
				return $callback;
			}

			if (is_array($callback)) {
				return $callback;
			}

			throw new \Exception($callback . ' is not a Callable', 1);
		}


		public function _add_action($action, $callable, $priority = 10, $accepted_args = []) {
			if ($priority === null) {
				$priority = 10;
			}
 			if (isset($this->actions[$action])) {
				$current_type = gettype($callable);
				$action_type = $this->actions[$action]["type"];
				if ($action_type !== $current_type) {
					throw new \Exception("Action \"{$action}\" must by type {$action_type}", 500);
				}
			} else {
				$this->actions[$action]["type"] = gettype($callable);
			}

			$this->actions[$action][$priority][] = [
				"type" => gettype($callable),
				"callable" => $callable,
				"args" => $accepted_args
			];
		}
	}
