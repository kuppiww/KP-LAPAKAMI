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
Route::prefix('user/layanan/skck')->group(function() {
    Route::get('/buat', 'ReqSKCKController@create');
    Route::post('/buat', 'ReqSKCKController@store');
    Route::get('/lihat/{id}', 'ReqSKCKController@show');
    Route::get('/ubah/{id}', 'ReqSKCKController@edit');
    Route::post('/update/{id}', 'ReqSKCKController@update');
    Route::get('/batal/{id}', 'ReqSKCKController@destroy');
});
