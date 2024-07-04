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

Route::prefix('user/layanan/kematian')->group(function() {
    Route::get('/buat', 'ReqDeathController@create');
    Route::post('/buat', 'ReqDeathController@store');
    Route::get('/lihat/{id}', 'ReqDeathController@show');
    Route::get('/ubah/{id}', 'ReqDeathController@edit');
    Route::post('/update/{id}', 'ReqDeathController@update');
    Route::get('/batal/{id}', 'ReqDeathController@destroy');
});
