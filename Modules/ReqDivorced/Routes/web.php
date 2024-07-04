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

Route::prefix('user/layanan/janda-duda')->group(function() {
    Route::get('/buat', 'ReqDivorcedController@create');
    Route::post('/buat', 'ReqDivorcedController@store');
    Route::get('/lihat/{id}', 'ReqDivorcedController@show');
    Route::get('/ubah/{id}', 'ReqDivorcedController@edit');
    Route::post('/update/{id}', 'ReqDivorcedController@update');
    Route::get('/batal/{id}', 'ReqDivorcedController@destroy');
});