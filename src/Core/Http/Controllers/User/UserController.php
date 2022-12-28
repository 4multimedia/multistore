<?php

    namespace Multimedia\Multistore\Core\Http\Controllers\User;

    use App\Http\Controllers\Controller;

    class UserController extends Controller
    {
        public function index() {
			set_title(__('backend::user.title'));
            add_action_header(__('backend::user.create'), route('backend.user.create'));
			return view('backend::user.index');
        }

		public function create() {
			set_title(__('backend::user.create'));
			return view('backend::user.create');
        }
    }
