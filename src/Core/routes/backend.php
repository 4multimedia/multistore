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

Route::prefix('auth')->group(function() {
    Route::get('login', 'Auth\LoginController@view')->name('backend.auth.login');
    Route::post('login', 'Auth\LoginController@login')->name('backend.auth.login.request');
    Route::post('login2', 'Auth\LoginController@login');
});
