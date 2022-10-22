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

?>
