<?php

    namespace Multimedia\Multistore\Core\Http\Controllers\Layout;

    use App\Http\Controllers\Controller;

    class SettingController extends Controller
    {
        public function index() {
			set_title(__('backend::layout.title'));
			return view('backend::layout.setting.index');
		}

        public function store() {
            set_title(__('backend::layout.create'));
        }
    }
