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
Route::prefix('user/layanan/kelahiran')->group(function() {
    Route::get('/buat', 'ReqBirthController@create');
    Route::post('/buat', 'ReqBirthController@store');
    Route::get('/lihat/{id}', 'ReqBirthController@show');
    Route::get('/ubah/{id}', 'ReqBirthController@edit');
    Route::post('/update/{id}', 'ReqBirthController@update');
    Route::get('/batal/{id}', 'ReqBirthController@destroy');
});