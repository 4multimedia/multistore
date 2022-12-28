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
Route::get('/access-blocked', 'Page\PageController@accessBlocked')->name('backend.access-blocked');

Route::prefix('auth')->namespace('Auth')->group(function() {
    Route::get('login', 'LoginController@view')->name('backend.auth.login');
    Route::post('login', 'LoginController@authenticate')->name('backend.auth.login.request');
    Route::get('logout', 'LogoutController@index')->name('backend.auth.logout');
});

Route::prefix('user')->namespace('User')->group(function() {
	Route::get('/', 'UserController@index')->name('backend.user');
	Route::get('/create', 'UserController@create')->name('backend.user.create');
	Route::get('/me', 'UserController@me')->name('backend.user.me');

    Route::prefix('group')->group(function() {
        Route::get('/', 'GroupController@index')->name('backend.user.group');
    });
});
