<?php

	function hook()
    {
        return app('hooks');
    }

    function form() {
        return app('form');
    }

	function plugins() {
		return app('plugins');
	}

	function register_css_path($path) {
		hook()->register_css_path($path);
	}

	function register_css($path, $place = 'all') {
		return hook()->register_css($path, $place);
	}

	function get_css() {
		return hook()->get_css();
	}

    function do_action($tag, $arg = '') {
        hook()->do_action($tag, $arg);
    }

    function add_action($tag, $callback, $priority = 10, $accepted_args = 1) {
        return hook()->add_action($tag, getHookCallback($callback), $priority, $accepted_args);
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

?>
