<?php

namespace Multimedia\Multistore\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

class RouteServiceProvider extends ServiceProvider {

    public $namespace = "Multimedia\Multistore\Core\Http\Controllers";
	public $namespace_api = "Multimedia\Multistore\Core\Http\Controllers\Api";

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
    }
}
