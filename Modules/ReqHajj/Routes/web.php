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

Route::prefix('user/layanan/ibadah-haji')->group(function() {
    Route::get('/buat', 'ReqHajjController@create');
    Route::post('/buat', 'ReqHajjController@store');
    Route::get('/lihat/{id}', 'ReqHajjController@show');
    Route::get('/ubah/{id}', 'ReqHajjController@edit');
    Route::post('/update/{id}', 'ReqHajjController@update');
    Route::get('/batal/{id}', 'ReqHajjController@destroy');
});
