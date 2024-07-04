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

Route::prefix('user/layanan/belum-memiliki-rumah')->group(function() {
    Route::get('/buat', 'ReqNotHouseController@create');
    Route::post('/buat', 'ReqNotHouseController@store');
    Route::get('/lihat/{id}', 'ReqNotHouseController@show');
    Route::get('/ubah/{id}', 'ReqNotHouseController@edit');
    Route::post('/update/{id}', 'ReqNotHouseController@update');
    Route::get('/batal/{id}', 'ReqNotHouseController@destroy');
});