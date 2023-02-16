<?php

namespace Multimedia\Multistore\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class MiddlewareServiceProvider extends ServiceProvider {

    public function register() {

    }

    public function boot() {
		app('router')->aliasMiddleware('multimedia.api', \Multimedia\Multistore\Core\Http\Middleware\Api::class);
        app('router')->aliasMiddleware('multimedia.backend', \Multimedia\Multistore\Core\Http\Middleware\Backend::class);
		app('router')->aliasMiddleware('multimedia.web', \Multimedia\Multistore\Core\Http\Middleware\Frontend::class);
    }
}
