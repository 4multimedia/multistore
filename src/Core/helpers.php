<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Multimedia\Multistore\Core\Models\Option;
use Multimedia\Multistore\Core\Models\Layout;
use Illuminate\Support\Facades\Schema;
use Multimedia\Multistore\Core\Models\Dictionary;
use Multimedia\Multistore\Core\Models\DictionaryRelative;
use Multimedia\Multistore\Core\Models\Navigation;
use Illuminate\Support\Facades\Request;
use Multimedia\Multistore\Core\Models\Meta;
use Multimedia\Multistore\Support\File;

	function hook() {
        return app('hooks');
    }

    function form($type = 'vue') {
        return app('form')->setType($type);
    }

	function plugins() {
		return app('plugins');
	}

	function menu() {
		return app('menu');
	}

	function modules() {
		return app('modules');
	}

	function user_log() {
		return app('user_log');
	}

	function backend() {
		return app('backend');
	}

	function media() {
		return app('media');
	}

	function table() {
		return app('table');
	}

	function domain() {
		return app('domain');
	}

	function layout() {
		return app('layout');
	}

    function page() {
		return app('page');
	}

    function slug() {
		return app('slug');
	}

	//

    /** Funkcja zwracająca widok lub obiekt JSON */
    function render_view($view, $data = []) {
        if(Request::wantsJson()) {
            return response()->json($data);
        } else {
            $view_replaced = str_replace('::', '.', $view);
            if (view()->exists($view_replaced)) {
                return view($view_replaced, $data);
            } else {
                return view($view, $data);
            }
        }
    }

    function register_slug_model($model) {
        slug()->register_model($model);
    }

	function isHTML($string){
		return $string != strip_tags($string) ? true:false;
	}

	function get_header() {
		return hook()->get_header();
	}

	function get_meta_all_tags() {
		$tags = [];
        $meta_tags = do_action('set_meta_tag');
        if ($meta_tags && is_array($meta_tags)) {
            foreach($meta_tags as $tag) {
                $tags[] = $tag;
            }
        }
		return implode(" ", $tags);
	}

	function register_meta_tags($params) {
		if (gettype($params) === 'string') {
			if (isHTML($params)) {
				return "\n\t\t".$params;
			}
		} else {
			$values = [];
			foreach($params as $key => $value) {
				$values[] = "$key=\"$value\"";
			}
			return "\n\t\t<meta ".implode(" ", $values).">";
		}
	}

	// CSS

	function register_css_path($path) {
		hook()->register_css_path($path);
	}

	function register_css($path, $place = 'all', $merge = true, $priority = 50) {
		return hook()->register_css($path, $place, $merge, $priority);
	}

	function register_assets_js($path, $position = 'after') {
		hook()->register_assets_js_path($path, $position);
	}

	function get_assets_backend_js($position = 'after') {
		hook()->get_assets_backend_js($position);
	}

	function get_assets_frontend_js($position = 'after') {
		hook()->get_assets_frontend_js($position);
	}

	function register_assets_code($code) {
		hook()->register_assets_code($code);
	}

	function get_css() {
		return hook()->get_css();
	}

	function register_asset_style($path, $merge = false) {
		hook()->register_asset_style($path, $merge);
	}

	function set_breadcrumbs() {

	}

	function generate_css_variables() {
		$data = get_option('layout.setting', []);
		$variables = [];
        if (isset($data["color"])) {
            $variables[] = "\t--primary: ".(isset($data["color"]["general"][0]["color"]) ? $data["color"]["general"][0]["color"] : "#cccccc").";";
            $variables[] = "\t--secondary: ".(isset($data["color"]["general"][1]["color"]) ? $data["color"]["general"][1]["color"] : "#cccccc").";";
            $variables[] = "\t--text: ".(isset($data["color"]["general"][2]["color"]) ? $data["color"]["general"][2]["color"] : "#cccccc").";";
            $variables[] = "\t--accent: ".(isset($data["color"]["general"][3]["color"]) ? $data["color"]["general"][3]["color"] : "#cccccc").";";
            $variables[] = "\t--link: ".(isset($data["color"]["general"][0]["link"]) ? $data["link"]["general"][0]["color"] : "#cccccc").";";
            $variables[] = "\t--link-hover: ".(isset($data["color"]["general"][1]["link"]) ? $data["link"]["general"][1]["color"] : "#cccccc").";";

            foreach($data["color"]["additional"] as $color) {
                $variables[] = "\t--".Str::slug($color["name"]).": ".$color["color"].";";
            }
        }

		$content = ":root { \n ".implode("\n", $variables)."\n }";

		$path = public_path('css');
        @mkdir(public_path('css'));
		return file_put_contents($path."/_variables.css", $content);
	}

	function generate_css_from_layout() {
		if (Schema::hasTable('layout')) {
			$groups = Layout::get()->toArray();
			layout()->extract_css($groups)->save();
		}
	}

	function get_modules() {
		return modules()->get_modules();
	}

	function get_meta_title($default = '') {
		return hook()->get_meta_title($default);
	}

	function get_title() {
		return hook()->get_title();
	}

	function get_name() {
		return '4Multi.Store';
	}

	function set_option($key, $value) {
		if (is_array($value)) {
			$value = json_encode($value, JSON_NUMERIC_CHECK|JSON_UNESCAPED_UNICODE);
		}
		Option::updateOrCreate(['key' => $key], ['values' => $value]);
	}

	function get_navigation($id_navigation) {
		$navigation = Navigation::find($id_navigation);
		if ($navigation) {
			return $navigation->items;
		}
	}

	function price($price) {
		return number_format($price, 2, ',', ' '). ' zł';
	}

	function get_breadcrumbs($options = []) {
		$separator = null;
		$class = 'breadcrumbs';
		$except = [];
		$only = [];
		if (isset($options["separator"])) { $separator = $options["separator"]; }
		if (isset($options["class"])) { $class = $options["class"]; }
		if (isset($options["except"])) { $except = $options["except"]; }
		if (isset($options["only"])) { $only = $options["only"]; }

		$breadcrumbs = do_action('set_breadcrumbs');
		$length = count($breadcrumbs);
		if ($breadcrumbs && $length > 1 && (is_array($breadcrumbs) || is_object($breadcrumbs))) {

			$current_route = Route::currentRouteName();

			$html = '<ul class="'.$class.'">';
			foreach($breadcrumbs as $key => $breadcrumb) {
				if (isset($breadcrumb["label"])) {
					$label = $breadcrumb["label"];
					$route = null;

					if (isset($breadcrumb["route"])) { $route = $breadcrumb["route"]; }

					$html .= '<li>';
					if (isset($route)) { $html .= '<a href="'.$route.'">'; }
					$html .= $label;
					if (isset($route)) { $html .= '</a>'; }
					$html .= '</li>';

					if ($separator && $key < $length-1) { $html .= '<li class="breadcrumbs-separator">'.$separator.'</li>'; }
				}
			}
			$html .= '</ul>';


			if (count($except) === 0) {
				return $html;
			} else if(!in_array($current_route, $except)) {
				return $html;
			}
		}
		return null;
	}

    function set_navigation_items($array = [], $module = null) {
        $menu = [];
        foreach($array as $item) {
            $menu[] = [
                'id_record' => $item["id"],
                'name' => $item["name"],
                'module' => $module,
                'route' => null
            ];
        }
        return $menu;
    }

	function get_domain($domain) {
		return domain()->get_domain($domain);
	}

    function add_domain($domain) {
        return domain()->add_domain($domain);
    }

    function get_dictionary_only_values($id_dictionary_parent, $id_record, $table) {
        return Dictionary::select('dictionary.id_dictionary', 'name')
        ->leftJoin('dictionary_relative', 'dictionary.id_dictionary', '=', 'dictionary_relative.id_dictionary')
		->where('id_record', $id_record)
		->where('table', $table)
		->where('id_dictionary_parent', $id_dictionary_parent)
        ->get()
        ->pluck('id')
        ->toArray();
    }

	function get_dictionary_values($id_dictionary_parent, $id_record, $table, $sort_col = null, $sort_by = null, $flat = true) {
        $lang = app()->getLocale();

        if (!$sort_col || !$sort_by) {
            $dictionary = Dictionary::where('id_dictionary', $id_dictionary_parent)->first();
            if ($dictionary) {
                if (isset($dictionary->options["sort_by"])) { $sort_by = $dictionary->options["sort_by"]; }
                if (isset($dictionary->options["sort_col"])) { $sort_col = $dictionary->options["sort_col"]; }
            }
        }

        if (!$sort_by) { $sort_by = 'asc'; }
        if (!$sort_col) { $sort_col = 'position'; }

        if ($sort_col === 'name') { $sort_col = 'name->'.$lang; }

		$query = Dictionary::select('dictionary.id_dictionary', 'name')
        ->leftJoin('dictionary_relative', 'dictionary.id_dictionary', '=', 'dictionary_relative.id_dictionary')
		->where('id_record', $id_record)
		->where('table', $table)
		->where('id_dictionary_parent', $id_dictionary_parent)
        ->orderBy($sort_col, $sort_by)
        ->get();

        if ($flat) {
            $items = $query->pluck('name.'.$lang, 'id');
        } else {
            $items = $query->map(function ($item) use ($lang) {
                return ['id' => $item->id, 'name' => $item->name[$lang]];
            });
        }

        return $items->toArray();
	}

    function save_dictionary($request, $id_record, $table) {
        DictionaryRelative::where('id_record', $id_record)->where('table', $table)->delete();

        if ($request) {
            foreach($request as $id_dictionary) {
                DictionaryRelative::updateOrCreate(['id_dictionary' => $id_dictionary, 'id_record' => $id_record, 'table' => $table]);
            }
        }
    }

	function get_dictionary_value($id_dictionary) {
        $lang = app()->getLocale();

		$item = Dictionary::select('dictionary.id_dictionary', 'name')
		->where('id_dictionary', $id_dictionary)
		->first();

        if ($item && $item->name[$lang]) {
            return $item->name[$lang];
        }
	}

    function get_dictionary($id_dictionary_parent, $sort_col = null, $sort_by = null, $flat = true) {
        $lang = app()->getLocale();

        if (!$sort_col || !$sort_by) {
            $dictionary = Dictionary::where('id_dictionary', $id_dictionary_parent)->first();
            if ($dictionary) {
                if (isset($dictionary->options["sort_by"])) { $sort_by = $dictionary->options["sort_by"]; }
                if (isset($dictionary->options["sort_col"])) { $sort_col = $dictionary->options["sort_col"]; }
            }
        }

        if (!$sort_by) { $sort_by = 'asc'; }
        if (!$sort_col) { $sort_col = 'position'; }

        if ($sort_col === 'name') { $sort_col = 'name->'.$lang; }

	    $query = Dictionary::select('dictionary.id_dictionary', 'name')
		->where('id_dictionary_parent', $id_dictionary_parent)
        ->orderBy($sort_col, $sort_by)
        ->get();

        if ($flat) {
            $items = $query->pluck('name.'.$lang, 'id_dictionary');
        } else {
            $items = $query->map(function ($item) use ($lang) {
                return ['id' => $item->id, 'name' => $item->name[$lang]];
            });
        }

        return $items->toArray();
	}

	function set_back_url() {
		$url = url()->previous();
		if (strpos($url, 'page=') !== false) {
			session()->put('url_back', $url);
		} else {
			session()->put('url_back', '');
		}
	}

	function get_back_url($route) {
		$url = session()->get('url_back');
		if ($url) {
			return redirect($url);
		} else {
			return redirect()->route($route);
		}
	}

    // save option
    function save_option($key, $value, $single = true, $domain = false) {
		$params = explode('.', $key);
		$group = mb_strtolower($params[0]);

		if (count($params) === 2) {
			$key = mb_strtolower($params[1]);
        	if ($single) {
                if ($domain) {
                    if ($value) {
                        Option::updateOrCreate(['group' => $group, 'key' => $key, 'id_option_domain' => domain()->current()->id], ['values' => $value]);
                    }
                } else {
                    Option::updateOrCreate(['group' => $group, 'key' => $key], ['values' => $value]);
                }
			} else {
				Option::create(['group' => $group, 'key' => $key, 'values' => $value]);
			}
		} else if (count($params) === 1) {
			if ($single) {
				if ($domain) {
                    if ($value) {
                        Option::updateOrCreate(['group' => $group, 'id_option_domain' => domain()->current()->id], ['values' => $value]);
                    }
                } else {
                    Option::updateOrCreate(['group' => $group], ['values' => $value]);
                }
			} else {
				Option::create(['group' => $group, 'values' => $value]);
			}
		}
    }

    function get_option($key, $default = null, $domain = false) {
		if (Schema::hasTable('option')) {
            $params = explode('.', $key);

            $group = $params[0];
            $key = $params[1];

			$query = Option::where('group', $group)->where('key', $key);
			if ($domain) {
				$query->where('id_option_domain', domain()->current()->id);
			}
			$option = $query->first();
			if ($option) {
				$data = $option->values;
				//$data = json_decode($data, true);
				return $data;
			}
			return $default;
		}
	}

    function add_hashids($models, $length = 64) {
        if ($models) {
            if (is_string($models)) {
                $model = $models;
                $models = (array)[];
                $models[] = $model;
            }
            $hashids_path = config_path('hashids.php');

            foreach($models as $model) {
                if (config('hashids.connections.',$model)) {
                    $line = "\t'$model' => [
            'salt' => '".Str::random(64)."',
            'length' => $length,
            'alphabet' => 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890'
        ],";

                    (new File($hashids_path))->findText("'connections' => [")->writeText($line);
                }
            }
        }
    }

	function get_host() {
		$protocol = 'http://';
		if (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) || isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
			$protocol = 'https://';
		}
		return $protocol.$_SERVER['SERVER_NAME'];
	}

	function set_title($title) {
		hook()->set_title($title);
	}

	function set_meta_title($title) {
		hook()->set_meta_title($title);
	}

	function add_action_header($label, $route = null, $color = null) {
		hook()->add_button_header($label, $route, $color);
	}

    function get_action_header() {
        return hook()->get_action_header();
    }

    function do_action($tag, $arg = '') {
        return hook()->do_action($tag, $arg);
    }

    function add_action_($tag, $callback, $priority = 10, $accepted_args = 1) {
        return hook()->add_action($tag, hook()->getHookCallback($callback), $priority, $accepted_args);
    }

	function add_to_menu($id, $title, $route = null, $priority = 10, $params = []) {
		menu()->add_to_menu($id, $title, $route, $priority, $params);
	}

	function add_to_submenu($id, $title, $route = null, $priority = 10, $params = []) {
		menu()->add_to_submenu($id, $title, $route, $priority, $params);
	}

    function add_devider_menu($priority) {
        menu()->add_devider_menu($priority);
    }

	function get_json_menu() {
		return menu()->get_json_menu();
	}

	function current_route() {
		return menu()->current_route();
	}

	function get_menu() {
		return menu()->do_menu();
	}

	function register_user_log($module, $id_record = null, $params = []) {
		return user_log()->register($module, $id_record, $params);
	}

    function apply_filters($tag, $value) {
        return hook()->apply_filters($tag, $value);
    }

    function add_filter($tag, $callback, $priority = 10, $accepted_args = 1) {
        return hook()->add_filter($tag, hook()->getHookCallback($callback), $priority, $accepted_args);
    }

	function get_backend_languages() {
		return backend()->get_languages();
	}

	function get_backend_language() {
		return backend()->get_language();
	}

    function category_routes($controller, $name) {
        Route::prefix('category')->group(function() use ($controller, $name) {
            Route::get('/', $controller.'@index')->name($name);
            Route::get('/tree', 'Tree'.$controller.'@index')->name($name.'.tree');
            Route::post('/tree', 'Tree'.$controller.'@store')->name($name.'.tree.store');
            Route::get('/create', $controller.'@create')->name($name.'.create');
            Route::post('/create', $controller.'@store')->name($name.'.store');
            Route::get('/{category}', $controller.'@update')->name($name.'.update');
            Route::put('/{category}', $controller.'@restore')->name($name.'.restore');
            Route::delete('/{category}', $controller.'@delete')->name($name.'.delete');
        });
    }

	// table

	function create_table($id, $options) {
		table()->create($id, $options);
	}

	function get_table($id) {
		return table()->render($id);
	}

	// db
	function get_primary_key_from_table($table) {
		$item = DB::select(DB::raw("show columns from `$table` where `Key` = \"PRI\";"));
		if ($item && $item[0] && $item[0]->Field) {
			return $item[0]->Field;
		}
		return null;
	}
	function has_column_in_table($table, $column) {
		return Schema::hasColumn($table, $column);
	}

	function get_model_namespace_from_table($model) {
		$models = do_action('register_table_model');
		if (is_array($models)) {
			foreach($models as $item) {
				if (isset($item[$model])) {
					return $item[$model];
				}
			}
		}
		return null;
	}

    function has_module($module) {
        $modules = do_action('register_module');
        foreach($modules as $module_key) {
            if ($module_key[0] === $module) {
                return true;
            }
        }
        return false;
    }

	function lower($string) {
		return Str::lower($string);
	}

	function json_merge($old, $new) {
		if ($old === null) {
			return $new;
		} else {
			return array_merge($old, $new);
		}
	}

	function save_meta($table, $id_record, $meta) {
		$title = $meta["title"];
		unset($meta["title"]);
		$item = Meta::where('table_name', $table)->where('id_record', $id_record)->first();
		if ($item) {
			$_title = json_merge($item->title, $title);
			$_meta = json_merge($item->meta, $meta);
			$item->update(['title' => $_title, 'meta' => $_meta]);
		} else {
			Meta::create([
				'table_name' => $table,
				'id_record' => $id_record,
				'title' => $title,
				'meta' => $meta
			]);
		}
	}

	// ACTIONS
	function add_action($tag, $arg, $priority = 10, $accepted_args = []) {
		hook()->_add_action($tag, $arg, $priority, $accepted_args);
	}

?>
