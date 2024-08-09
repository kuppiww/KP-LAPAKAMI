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

Route::prefix('user/layanan/sktm')->group(function() {
    Route::get('/buat', 'ReqSktmController@create');
    Route::post('/buat', 'ReqSktmController@store');
    Route::get('/lihat/{id}', 'ReqSktmController@show');
    Route::get('/ubah/{id}', 'ReqSktmController@edit');
    Route::post('/update/{id}', 'ReqSktmController@update');
    Route::get('/batal/{id}', 'ReqSktmController@destroy');
    Route::get('/pdf/{id}/{service}', 'ReqSktmController@pdf');
    Route::post('/tangguhkan/{id}', 'ReqSktmController@tangguhkan');
    Route::post('/tolak/{id}', 'ReqSktmController@tolak');
    Route::post('/updatepermohonan/{id}', 'ReqSktmController@updatepermohonan');
});

Route::prefix('operator/sktm')->group(function() {
    Route::get('/lihat/{id}', 'ReqSktmController@showPermohoanan');
    Route::get('/sesuai/{id}', 'ReqSktmController@proses');
});
