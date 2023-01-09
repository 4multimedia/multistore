<?php

    namespace Multimedia\Multistore\Core\Http\Controllers\Content;

    use App\Http\Controllers\Controller;

    class LayoutController extends Controller
    {
        public function index() {
			set_title(__('backend::layout.title'));
            add_action_header(__('backend::layout.create'), route('backend.layout.create'));
			return view('backend::content.layout.index');
		}

        public function create() {
            set_title(__('backend::layout.create'));
            return view('backend::content.layout.create');
        }
    }
