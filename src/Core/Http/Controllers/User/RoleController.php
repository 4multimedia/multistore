<?php

    namespace Multimedia\Multistore\Core\Http\Controllers\User;

    use App\Http\Controllers\Controller;

    class RoleController extends Controller
    {
        public function index() {
			return view('backend::user.role.index');
        }

		public function create() {
			return view('backend::user.role.create');
        }
    }
