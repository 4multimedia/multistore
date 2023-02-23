<?php

use Illuminate\Support\Facades\Route;
use Multimedia\Multistore\Core\Models\Page;

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

$pages = Page::get()->pluck('slug.pl')->toArray();

Route::namespace('Content')->group(function() use ($pages) {
	Route::get('/{page}', 'PageController@view')->whereIn('page', $pages);
});
