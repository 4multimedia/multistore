<?php

    namespace Multimedia\Multistore\Core\Http\Controllers\Auth;

    use App\Http\Controllers\Controller;
	use Illuminate\Support\Facades\Auth;
    use Multimedia\Multistore\Core\Http\Requests\LoginRequest;

    class LoginController extends Controller
    {
        public function view() {
            return view('backend::auth.login');
        }

        public function authenticate(LoginRequest $request) {
			$credentials = [
				'email' => $request->email,
				'password' => $request->password,
				'id_user_status' => 2
			];

			if (Auth::attempt($credentials)) {
				$request->session()->regenerate();
				return redirect()->intended('backend.dashboard');
			}

			return back()->withErrors(['email' => 'The provided credentials do not match our records.'])->onlyInput('email');
        }
    }
