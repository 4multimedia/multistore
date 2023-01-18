<?php

namespace Multimedia\Multistore\Core\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Frontend {

	public function handle(Request $request, Closure $next) {
		return $next($request);
	}
}
