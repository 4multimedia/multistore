<?php

    namespace Multimedia\Multistore\Core\Http\Controllers\Auth;

	use Multimedia\Multistore\Core\Models\User;
	use Multimedia\Multistore\Core\Http\Controllers\Controller;
	use Illuminate\Support\Facades\Auth;
    use Multimedia\Multistore\Core\Http\Requests\Auth\LoginRequest;

    class LoginController extends Controller
    {
        public function view() {
            return view('backend::auth.login');
        }

        public function authenticate(LoginRequest $request) {
			$credentials = [
				'email' => $request->email,
				'password' => $request->password,
			];

			if (auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
                register_user_log('Login');
				return redirect()->route('backend.dashboard')->with('success', __('backend::auth.You have been successfully logged into the administration panel'));
			}

			return back()->withErrors(['email' => __('backend::auth.The email address or password is incorrect')])->onlyInput('email');
        }
    }
