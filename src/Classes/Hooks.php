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

		/* HOOKS JavaScript */
		public function register_assets_js_path($path, $position = 'after') {
			if (!in_array($path, $this->assets_js[$position])) {
				$this->assets_js[$position][] = $path;
			}
		}

		public function get_assets_backend_js($position = 'after') {
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

        public function do_action($tag, $arg = '') {
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
                        call_user_func_array($the_['function'], array_slice($args, 0, (int) $the_['accepted_args']));
                    }
                }
            } while (next($this->filters[$tag]) !== false);

            array_pop($this->current_filter);
        }
	}
