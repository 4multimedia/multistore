<?php

namespace Multimedia\Multistore\Core\Http\Middleware;

use Closure;
use Illuminate\Routing\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Multimedia\Multistore\Core\Models\UserRole;

class Backend
{
    protected $routesAuth = [
        'backend.auth.login',
        'backend.auth.login.request',
        'backend.auth.reset',
        'backend.auth.password',
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

        $routeName = $request->route()->getName();
		if (Auth::check()) {
            $admin_roles = UserRole::where("area->backend", true)->pluck('id_user_role')->toArray();
            $user = $request->user();

            $has_admin_role = array_intersect($admin_roles, $user->getRoles());
            if ($routeName === 'backend.access-blocked') {
                return $next($request);
            }
            else if ($has_admin_role) {
                if (in_array($routeName, $this->routesAuth)) {
                    return redirect()->route('backend.dashboard');
                } else {
                    return $next($request);
                }
            } else {
                return redirect()->route('backend.access-blocked');
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
