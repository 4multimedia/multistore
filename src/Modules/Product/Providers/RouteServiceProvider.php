<?php

namespace App\Modules\Product\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider {

    public $namespaceFrontend = "App\Modules\Product\Http\Controllers\Frontend";
    public $namespaceBackend = "App\Modules\Product\Http\Controllers\Backend";
    public $namespaceApi = "App\Modules\Product\Http\Controllers\Api";

    public function register() {

    }

    public function boot() {
        Route::namespace($this->namespaceFrontend)
        ->middleware(['web', 'multimedia.web'])
        ->group(app_path('Modules/Product/routes/web.php'));

        Route::namespace($this->namespaceApi)
        ->prefix('api')
        ->middleware(['api', 'multimedia.api'])
        ->group(app_path('Modules/Product/routes/api.php'));

        Route::namespace($this->namespaceBackend)
        ->prefix(config('multimedia.backend'))
        ->middleware(['web', 'multimedia.backend'])
        ->group(app_path('Modules/Product/routes/backend.php'));
    }
}
