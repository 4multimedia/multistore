<?php

    namespace Multimedia\Multistore\Core\Http\Controllers\Dashboard;

    use App\Http\Controllers\Controller;
    use Multimedia\Multistore\Core\Http\Requests\LoginRequest;

    class IndexController extends Controller
    {
        public function index() {
			set_title(__('backend::dashboard.title'));

			return view('backend::index.index');
        }
    }
