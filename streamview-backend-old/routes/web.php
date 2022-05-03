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
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'cors'], function(){

Route::any('/ge_key', 'ApplicationController@get_encrypt_key')->name('get_encrypt_key');

Route::get('/embed', 'ApplicationController@embed_video')->name('embed_video');

Route::get('/g_embed', 'ApplicationController@genre_embed_video')->name('genre_embed_video');

});
