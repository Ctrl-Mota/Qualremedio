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
Route::get('/sitemap', 'SiteMapController@index');
Route::get('/sitemap/med', 'SiteMapController@med');
Route::get('/sitemap/principio-ativo', 'SiteMapController@activePrinc');


Route::get('/', 'medController@index')->name('index');
Route::post('/search', 'medController@search')->name('search');
Route::get('/principio-ativo/{active_princ}', 'medController@activeP')->name('activeP');
// Medsingle
Route::get('/medicamento/{slug}', 'medController@medSingle')->name('single');
    // Comments
    Route::post('/storecomment', 'CommentsController@storeComment')->name('storecomment');
    Route::post('/storereply', 'CommentsController@storeReply')->name('storereply');
    Route::get('/listcomments', 'CommentsController@listComments')->name('listcomment');

