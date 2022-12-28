<?php

    namespace Multimedia\Multistore\Core\Http\Controllers\User;

    use App\Http\Controllers\Controller;

    class GroupController extends Controller
    {
        public function index() {
			return view('backend::user.group.index');
        }

		public function create() {
			return view('backend::user.group.create');
        }
    }
