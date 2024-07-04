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

Route::prefix('user/layanan/domisili')->group(function() {
    Route::get('/buat', 'ReqDomicileController@create');
    Route::post('/buat', 'ReqDomicileController@store');
    Route::get('/lihat/{id}', 'ReqDomicileController@show');
    Route::get('/ubah/{id}', 'ReqDomicileController@edit');
    Route::post('/update/{id}', 'ReqDomicileController@update');
    Route::get('/batal/{id}', 'ReqDomicileController@destroy');
});
