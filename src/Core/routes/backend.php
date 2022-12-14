<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Backend Routes
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

	Route::get('reset', 'ResetController@view')->name('backend.auth.reset');
	Route::post('reset', 'ResetController@reset')->name('backend.auth.reset.request');
});

Route::prefix('user')->namespace('User')->group(function() {
	Route::get('/', 'UserController@index')->name('backend.user');
	Route::get('/create', 'UserController@create')->name('backend.user.create');
	Route::get('/me', 'UserController@me')->name('backend.user.me');

    Route::prefix('group')->group(function() {
        Route::get('/', 'GroupController@index')->name('backend.user.group');
    });
});

Route::prefix('media')->namespace('Media')->group(function() {
	Route::get('/{hash?}', 'MediaController@index')->name('backend.media');
	Route::post('/upload', 'UploadController@index');
});

Route::namespace('Content')->group(function() {
	Route::prefix('page')->group(function() {
		Route::get('/', 'PageController@index')->name('backend.page');
		Route::get('/create', 'PageController@create')->name('backend.page.create');
	});
});

Route::namespace('Layout')->prefix('layout')->group(function() {
	Route::get('/', 'DefaultController@index')->name('backend.layout');
	Route::get('/create', 'DefaultController@create')->name('backend.layout.create');
	Route::post('/store', 'DefaultController@store')->name('backend.layout.store');

	Route::prefix('setting')->group(function() {
		Route::get('/', 'SettingController@index')->name('backend.layout.setting.index');
		Route::post('/', 'SettingController@store')->name('backend.layout.setting.store');
	});
});
