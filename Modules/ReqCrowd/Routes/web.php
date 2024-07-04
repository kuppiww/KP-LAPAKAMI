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

Route::prefix('user/layanan/izin-keramaian')->group(function() {
    Route::get('/buat', 'ReqCrowdController@create');
    Route::post('/buat', 'ReqCrowdController@store');
    Route::get('/lihat/{id}', 'ReqCrowdController@show');
    Route::get('/ubah/{id}', 'ReqCrowdController@edit');
    Route::post('/update/{id}', 'ReqCrowdController@update');
    Route::get('/batal/{id}', 'ReqCrowdController@destroy');
});