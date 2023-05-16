<?php

namespace Multimedia\Multistore\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

class RouteServiceProvider extends ServiceProvider {

    public $namespace = "Multimedia\Multistore\Core\Http\Controllers";
    public $namespace_frontend = "Multimedia\Multistore\Core\Http\Controllers\Frontend";
	public $namespace_api = "Multimedia\Multistore\Core\Http\Controllers\Api";

    public $web_namespace_backend = "App\Http\Controllers\Backend";
    public $web_namespace_frontend = "App\Http\Controllers\Frontend";

    public function register() {

    }

    public function boot() {
        Route::namespace($this->namespace)
        ->prefix(config('multimedia.backend'))
        ->middleware(['web', 'multimedia.backend'])
        ->group(dirname(__FILE__).'/../Core/routes/backend.php');

		Route::namespace($this->namespace_api)
        ->prefix(config('multimedia.backend').'/api')
		->middleware(['api'])
        ->group(dirname(__FILE__).'/../Core/routes/api.php');

		Route::namespace($this->namespace_frontend)
        ->middleware(['web'])
        ->group(dirname(__FILE__).'/../Core/routes/frontend.php');

		Route::namespace($this->web_namespace_backend)
        ->prefix(config('multimedia.backend'))
        ->middleware(['web', 'multimedia.backend'])
        ->group(base_path('routes/backend.php'));

		Route::namespace($this->web_namespace_frontend)
        ->middleware(['web', 'multimedia.web'])
        ->group(base_path('routes/frontend.php'));
    }
}
