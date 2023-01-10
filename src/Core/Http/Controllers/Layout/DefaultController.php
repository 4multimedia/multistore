<?php

    namespace Multimedia\Multistore\Core\Http\Controllers\Layout;

    use App\Http\Controllers\Controller;

    class DefaultController extends Controller
    {
        public function index() {
			set_title(__('backend::layout.title'));
            add_action_header(__('backend::layout.create'), route('backend.layout.create'));
			return view('backend::layout.default.index');
		}

        public function create() {
            set_title(__('backend::layout.create'));
            return view('backend::layout.default.create');
        }
    }
