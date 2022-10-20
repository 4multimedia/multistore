<?php

    namespace Multimedia\Multistore\Core\Http\Controllers\Auth;

    use App\Http\Controllers\Controller;
    use Multimedia\Multistore\Core\Http\Requests\LoginRequest;

    class LoginController extends Controller
    {
        public function view() {
            return view('backend::auth.login');
        }

        public function login(LoginRequest $request) {

        }
    }
