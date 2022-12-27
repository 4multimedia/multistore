<?php

namespace Multimedia\Multistore\Core\Http\Middleware;

use Closure;
use Illuminate\Routing\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Backend
{
    protected $routesAuth = [
        'backend.auth.login',
        'backend.auth.login.request',
        'backend.auth.reset',
        'backend.auth.password'
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
		$user = $request->user();
        $routeName = $request->route()->getName();
		if (Auth::check()) {
			if (in_array($routeName, $this->routesAuth)) {
				return redirect()->route('backend.dashboard');
			} else {
				return $next($request);
			}
		}
		else {
			if (in_array($routeName, $this->routesAuth)) {
				return $next($request);
			} else {
				return redirect()->route('backend.auth.login');
			}
		}
    }
}
