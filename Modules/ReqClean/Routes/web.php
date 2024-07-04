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
Route::prefix('user/layanan/bersih-diri')->group(function() {
    Route::get('/buat', 'ReqCleanController@create');
    Route::post('/buat', 'ReqCleanController@store');
    Route::get('/lihat/{id}', 'ReqCleanController@show');
    Route::get('/ubah/{id}', 'ReqCleanController@edit');
    Route::post('/update/{id}', 'ReqCleanController@update');
    Route::get('/batal/{id}', 'ReqCleanController@destroy');
});
