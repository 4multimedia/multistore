<?php

use Illuminate\Support\Facades\Route;
use Multimedia\Multistore\Core\Models\Page;
use Illuminate\Support\Facades\Schema;
use Multimedia\Multistore\Core\Models\ArticleCategory;

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
$pages = [];
$articles_category = [];
if (Schema::hasTable('page')) {
    $pages = Page::get()->pluck('slug.pl')->toArray();
}

if (Schema::hasTable('article_category')) {
    $articles_category = ArticleCategory::get()->pluck('slug')->toArray();
}

Route::namespace('Content')->group(function() use ($pages, $articles_category) {
    Route::get('/', 'PageController@index')->name('home');
    if (count($pages)) {
	    Route::get('/{page}', 'PageController@view')->whereIn('page', $pages);
    }
	if (count($articles_category)) {
	    Route::get('/{articlesCategory}', 'Article\CategoryController@index')->whereIn('articlesCategory', $articles_category);
    }
});
