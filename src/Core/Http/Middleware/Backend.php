<?php

namespace Multimedia\Multistore\Core\Http\Middleware;

use Closure;
use Illuminate\Routing\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Multimedia\Multistore\Core\Models\OptionDomain;
use Multimedia\Multistore\Core\Models\UserRole;

class Backend
{
    protected $routesAuth = [
        'backend.auth.login',
        'backend.auth.login.request',
        'backend.auth.reset',
        'backend.auth.password',
		'backend.auth.reset.request',
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
		if ($request->has('lang')) {
			app()->setLocale($request->lang);
			$request->session()->put('_language', $request->lang);
		} else {
			$sessionLanguage = $request->session()->get('_language', app()->getLocale());
			app()->setLocale($sessionLanguage);
		}

        $routeName = $request->route()->getName();
		if (Auth::check()) {
            $admin_roles = UserRole::where("area->backend", true)->pluck('id_user_role')->toArray();
            $user = $request->user();

			$current_domain = null;
			if ($request->has('domain')) {
				config('_domain', $request->domain);
				$request->session()->put('_domain', $request->domain);
				domain()->set_id_option_domain($request->domain);
				$current_domain = $request->domain;
			}
			else if ($request->session()->has('_domain')) {
				$current_domain = $request->session()->get('_domain');
				config('_domain', $request->session()->get('_domain'));
				domain()->set_id_option_domain($request->session()->get('_domain'));
			}

			if ($current_domain !== null) {
				$find_domain = OptionDomain::where('id_option_domain', $current_domain)->first();
				if (!$find_domain) {
					config('_domain', null);
					$request->session()->forget('_domain');
					domain()->set_id_option_domain(null);
					$current_domain = null;
				}
			}

			if ($current_domain === null) {
				$domains = domain()->get_list();
				if ($domains && isset($domains[0])) {
					$domain = $domains[0]->id_option_domain;
					config('_domain', $domain);
					domain()->set_id_option_domain($domain);
					$request->session()->put('_domain', $domain);
				} else {
					if (strpos($routeName, 'backend.setting.domain') === false) {
						return redirect()->route('backend.setting.domain');
					}
				}
			}

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
