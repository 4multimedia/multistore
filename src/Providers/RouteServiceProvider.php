<?php

namespace Multimedia\Multistore\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

class RouteServiceProvider extends ServiceProvider {

    public $namespace = "Multimedia\Multistore\Core\Http\Controllers";

    public function register() {

    }

    public function boot() {
        Route::namespace($this->namespace)
        ->prefix(config('multimedia.backend'))
        ->middleware(['multimedia.backend', 'web'])
        ->group(dirname(__FILE__).'/../Core/routes/backend.php');
    }
}
