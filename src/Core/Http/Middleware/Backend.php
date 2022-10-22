<?php

namespace Multimedia\Multistore\Core\Http\Middleware;

use Closure;
use Illuminate\Routing\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Backend
{
    protected $route;

    protected $routesAuth = [
        'backend.auth.login',
        'backend.auth.login.request',
        'backend.auth.reset',
        'backend.auth.password'
    ];

    public function __construct(Route $route)
    {
        $this->route = $route;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $routeName = $this->route->getName();
		if (Auth::check()) {
			echo '1234 = zalogowany '; die;
		}
        if (in_array($routeName, $this->routesAuth)) {
            return $next($request);
        } else {
            return redirect()->route('backend.auth.login');
        }
    }
}
