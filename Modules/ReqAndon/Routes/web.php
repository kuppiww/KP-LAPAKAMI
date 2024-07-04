<?php

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

Route::prefix('user/layanan/andon-nikah')->group(function() {
    Route::get('/buat', 'ReqAndonController@create');
    Route::post('/buat', 'ReqAndonController@store');
    Route::get('/lihat/{id}', 'ReqAndonController@show');
    Route::get('/ubah/{id}', 'ReqAndonController@edit');
    Route::post('/update/{id}', 'ReqAndonController@update');
    Route::get('/batal/{id}', 'ReqAndonController@destroy');
});