<?php

    namespace Multimedia\Multistore\Core\Http\Controllers\Auth;

    use Multimedia\Multistore\Core\Http\Controllers\Controller;
	use Illuminate\Support\Facades\Auth;
    use Multimedia\Multistore\Core\Http\Requests\LoginRequest;

    class LogoutController extends Controller
    {
        public function index() {
			Auth::logout();
			return redirect()->route('backend.auth.login');
        }
    }
