<?php

    use Illuminate\Support\Facades\Route;

	function hook() {
        return app('hooks');
    }

    function form() {
        return app('form');
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

	function register_css_path($path) {
		hook()->register_css_path($path);
	}

	function register_css($path, $place = 'all') {
		return hook()->register_css($path, $place);
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

	function get_css() {
		return hook()->get_css();
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

	function get_host() {
		$protocol = 'http://';
		if (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) || isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
			$protocol = 'https://';
		}

		return $protocol.$_SERVER['SERVER_NAME'];
	}

	function has_module($module) {
		return modules()->has_module($module);
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
        hook()->do_action($tag, $arg);
    }

    function add_action($tag, $callback, $priority = 10, $accepted_args = 1) {
        return hook()->add_action($tag, getHookCallback($callback), $priority, $accepted_args);
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

    function getHookCallback($callback) {
        if (is_string($callback) && strpos($callback, '@')) {
            $callback = explode('@', $callback);
            return [app('\\'.$callback[0]), $callback[1]];
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

    function apply_filters($tag, $value) {
        return hook()->apply_filters($tag, $value);
    }

    function add_filter($tag, $callback, $priority = 10, $accepted_args = 1) {
        return hook()->add_filter($tag, getHookCallback($callback), $priority, $accepted_args);
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
            Route::get('/create', $controller.'@create')->name($name.'.create');
            Route::post('/create', $controller.'@store')->name($name.'.store');
            Route::get('/{category}', $controller.'@update')->name($name.'.update');
            Route::put('/{category}', $controller.'@restore')->name($name.'.restore');
            Route::delete('/{category}', $controller.'@delete')->name($name.'.delete');
        });
    }

?>
