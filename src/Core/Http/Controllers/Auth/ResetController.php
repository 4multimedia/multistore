<?php

    namespace Multimedia\Multistore\Core\Http\Controllers\Auth;

	use Multimedia\Multistore\Core\Http\Controllers\Controller;
	use Multimedia\Multistore\Core\Http\Requests\Auth\ResetRequest;
	use Multimedia\Multistore\Core\Models\User;
	use Mail;

    class ResetController extends Controller
    {
        public function view() {
            return view('backend::auth.reset');
        }

		public function reset(ResetRequest $request) {
			$user = User::where('email', $request->email)->first();
			if ($user && $user->hasBackendAccess) {
				$token = 'abc';
				$data = [
					'email' => $request->email,
					'token' => $token
				];

				Mail::mailer('array')->send('backend::mail.reset', $data, function($message) use ($request) {
					$message->to($request->email)->subject('Odzyskaj hasło');
					$message->from('autoresponder@4multi.store');
				});

				return redirect()->route('backend.auth.login')->with('success', __('backend::auth.A message with a link to reset your password has been sent to the address provided. Receive the message and follow the instructions in the email.'));
			} else {
				return back()->withErrors(['email' => __('backend::auth.The e-mail address does not exist or is not accessible')])->onlyInput('email');
			}
		}
    }
