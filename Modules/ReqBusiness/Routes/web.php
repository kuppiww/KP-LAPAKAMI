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

Route::prefix('user/layanan/mempunyai-usaha')->group(function() {
    Route::get('/buat', 'ReqBusinessController@create');
    Route::post('/buat', 'ReqBusinessController@store');
    Route::get('/lihat/{id}', 'ReqBusinessController@show');
    Route::get('/ubah/{id}', 'ReqBusinessController@edit');
    Route::post('/update/{id}', 'ReqBusinessController@update');
    Route::get('/batal/{id}', 'ReqBusinessController@destroy');
});