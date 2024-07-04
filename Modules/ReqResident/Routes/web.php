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

Route::prefix('user/layanan/penduduk')->group(function() {
    Route::get('/buat', 'ReqResidentController@create');
    Route::post('/buat', 'ReqResidentController@store');
    Route::get('/lihat/{id}', 'ReqResidentController@show');
    Route::get('/ubah/{id}', 'ReqResidentController@edit');
    Route::post('/update/{id}', 'ReqResidentController@update');
    Route::get('/batal/{id}', 'ReqResidentController@destroy');
});
