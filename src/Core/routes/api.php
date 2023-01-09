<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('media')->namespace('Media')->group(function() {
	Route::get('/', 'MediaController@index');

	Route::prefix('directory')->group(function() {
		Route::get('/trash', 'DirectoryController@trash');
		Route::get('/{mediaDirectory?}', 'DirectoryController@index');
		Route::get('/view/{mediaDirectory}', 'DirectoryController@view');
		Route::post('/{mediaDirectory?}', 'DirectoryController@store');
		Route::put('/{mediaDirectory}', 'DirectoryController@restore');
		Route::delete('/{mediaDirectory}', 'DirectoryController@delete');
	});

	Route::prefix('all')->group(function() {
		Route::get('/trash', 'AllController@trash');
		Route::get('/{mediaDirectory?}', 'AllController@index');
		Route::get('/view/{mediaDirectory}', 'AllController@view');
		Route::post('/{mediaDirectory?}', 'AllController@store');
		Route::put('/{mediaDirectory}', 'AllController@restore');
		Route::delete('/{mediaDirectory}', 'AllController@delete');
	});
});

Route::get('lang/{lang}', 'Content\LangController@index');
