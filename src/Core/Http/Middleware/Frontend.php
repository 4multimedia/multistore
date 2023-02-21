<?php

namespace Multimedia\Multistore\Core\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Frontend {

	public function handle(Request $request, Closure $next) {
		$root = parse_url($request->root());
		$scheme = $root["scheme"];
		$host = $root["host"];

		$domain = get_domain($host);
		if ($domain) {
			domain()->set_id_option_domain($domain->id_option_domain);
		}
		return $next($request);
	}
}
