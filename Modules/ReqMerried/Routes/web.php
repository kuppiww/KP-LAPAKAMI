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

Route::prefix('user/layanan/belum-menikah')->group(function() {
    Route::get('/buat', 'ReqMerriedController@create');
    Route::post('/buat', 'ReqMerriedController@store');
    Route::get('/lihat/{id}', 'ReqMerriedController@show');
    Route::get('/ubah/{id}', 'ReqMerriedController@edit');
    Route::post('/update/{id}', 'ReqMerriedController@update');
    Route::get('/batal/{id}', 'ReqMerriedController@destroy');
});