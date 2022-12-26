<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'Dashboard\IndexController@index')->name('backend.dashboard');

Route::prefix('auth')->namespace('Auth')->group(function() {
    Route::get('login', 'LoginController@view')->name('backend.auth.login');
    Route::post('login', 'LoginController@authenticate')->name('backend.auth.login.request');
    Route::get('logout', 'LogoutController@view')->name('backend.auth.logout');
});
