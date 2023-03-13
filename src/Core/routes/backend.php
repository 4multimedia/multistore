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
        Route::get('/tree', 'PageController@tree')->name('backend.page.tree');
		Route::post('/create', 'PageController@store')->name('backend.page.store');
		Route::get('/{hash}', 'PageController@update')->name('backend.page.update');
		Route::post('/{hash}', 'PageController@restore')->name('backend.page.restore');
		Route::delete('/{hash}', 'PageController@delete')->name('backend.page.delete');
	});

	Route::prefix('navigation')->group(function() {
		Route::get('/', 'NavigationController@index')->name('backend.navigation');
		Route::get('/create', 'NavigationController@create')->name('backend.navigation.create');
		Route::post('/create', 'NavigationController@store')->name('backend.navigation.store');
        Route::get('/{hash}', 'NavigationController@update')->name('backend.navigation.update');
        Route::get('/items/{hash}', 'NavigationController@items')->name('backend.navigation.items');
        Route::delete('/{hash}', 'NavigationController@delete')->name('backend.navigation.delete');
	});

    Route::prefix('article')->namespace('Article')->group(function() {
        Route::get('/', 'ItemController@index')->name('backend.article');

        category_routes('CategoryController', 'backend.article.category');
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

Route::namespace('Setting')->prefix('setting')->group(function() {
	Route::prefix('domains')->group(function() {
		Route::get('/', 'DomainController@index')->name('backend.setting.domain');
		Route::get('/create', 'DomainController@create')->name('backend.setting.domain.create');
		Route::post('/create', 'DomainController@store')->name('backend.setting.domain.store');
		Route::get('/{optionDomain}', 'DomainController@update')->name('backend.setting.domain.update');
		Route::post('/{optionDomain}', 'DomainController@restore')->name('backend.setting.domain.restore');
		Route::delete('/{optionDomain}', 'DomainController@delete')->name('backend.setting.domain.delete');
	});

	Route::prefix('language')->group(function() {
		Route::get('/', 'LanguageController@index')->name('backend.setting.language');
		Route::post('/', 'LanguageController@store');
	});

	Route::prefix('dictionary')->group(function() {
		Route::get('/{group}', 'DictionaryController@index')->name('backend.dictionary');
		Route::get('/{group}/create', 'DictionaryController@create')->name('backend.dictionary.create');
		Route::post('/{group}/create', 'DictionaryController@store');
		Route::get('/item/{dictionary}', 'DictionaryController@update')->name('backend.dictionary.update');
		Route::post('/item/{dictionary}', 'DictionaryController@restore');
		Route::delete('/item/{dictionary}', 'DictionaryController@delete')->name('backend.dictionary.delete');

		Route::get('/setting/{group}', 'DictionaryController@setting')->name('backend.dictionary.setting');
		Route::post('/setting/{group}', 'DictionaryController@storeSetting');
	});
});
