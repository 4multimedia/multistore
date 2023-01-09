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

	Route::prefix('producer')->group(function() {
		Route::get('/', 'ProducerController@index')->name('backend.product.producer');
        Route::get('/create', 'ProducerController@create')->name('backend.product.producer.create');
		Route::post('/create', 'ProducerController@store')->name('backend.product.producer.store');
		Route::get('/{producer}', 'ProducerController@update')->name('backend.product.producer.update');
		Route::put('/{producer}', 'ProducerController@restore')->name('backend.product.producer.restore');
		Route::delete('/{producer}', 'ProducerController@delete')->name('backend.product.producer.delete');
	});
});
