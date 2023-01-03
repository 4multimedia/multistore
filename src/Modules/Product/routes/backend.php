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

Route::prefix('product')->group(function() {
	Route::get('/', 'ProductController@index')->name('backend.product');

	Route::prefix('category')->group(function() {
		Route::get('/', 'CategoryController@index')->name('backend.product.category');
		Route::get('/create', 'CategoryController@create')->name('backend.product.category.create');
		Route::post('/create', 'CategoryController@store')->name('backend.product.category.store');
		Route::get('/{category}', 'CategoryController@update')->name('backend.product.category.update');
		Route::put('/{category}', 'CategoryController@restore')->name('backend.product.category.restore');
		Route::delete('/{category}', 'CategoryController@delete')->name('backend.product.category.delete');
	});

	Route::prefix('producer')->group(function() {
		Route::get('/', 'ProducerController@index')->name('backend.product.producer');
	});
});
