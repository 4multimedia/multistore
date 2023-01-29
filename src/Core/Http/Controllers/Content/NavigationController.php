<?php

    namespace Multimedia\Multistore\Core\Http\Controllers\Content;

    use App\Http\Controllers\Controller;

    class NavigationController extends Controller
    {
        public function index() {
			set_title(__('backend::navigation.title'));
            add_action_header(__('backend::navigation.create'), route('backend.navigation.create'));

            do_action('register_to_navigation');
			return view('backend::content.navigation.index');
		}

        public function create() {
            set_title(__('backend::page.create'));
            return view('backend::content.page.create');
        }
    }
