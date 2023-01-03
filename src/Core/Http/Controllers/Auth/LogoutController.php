<?php

    namespace Multimedia\Multistore\Core\Http\Controllers\Auth;

    use Multimedia\Multistore\Core\Http\Controllers\Controller;
	use Illuminate\Support\Facades\Auth;
    use Multimedia\Multistore\Core\Http\Requests\LoginRequest;

    class LogoutController extends Controller
    {
        public function index() {
            register_user_log('Logout');
			Auth::logout();
			return redirect()->route('backend.auth.login')->with('success', __('backend::auth.You have been successfully logged out of the administration panel'));
        }
    }
