<?php

    namespace Multimedia\Multistore\Core\Http\Controllers\Auth;

	use Multimedia\Multistore\Core\Http\Controllers\Controller;
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

			if (auth()->attempt($credentials)) {
				$request->session()->regenerate();
                register_user_log('Login');
				auth()->user()->createToken('app')->plainTextToken;
				return redirect()->route('backend.dashboard')->with('success', __('backend::auth.You have been successfully logged into the administration panel'));
			}

			return back()->withErrors(['email' => __('backend::auth.The email address or password is incorrect')])->onlyInput('email');
        }
    }
