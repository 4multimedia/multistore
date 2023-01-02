<?php

    namespace Multimedia\Multistore\Core\Http\Controllers\Content;

    use App\Http\Controllers\Controller;

    class PageController extends Controller
    {
        public function index() {
			set_title(__('backend::page.title'));
            add_action_header(__('backend::page.create'), route('backend.page.create'));
			return view('backend::content.page.index');
		}

        public function create() {
            set_title(__('backend::page.create'));
            return view('backend::content.page.create');
        }
    }
