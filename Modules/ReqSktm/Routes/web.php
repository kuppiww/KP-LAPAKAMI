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

use Illuminate\Support\Facades\Route;

Route::prefix('user/layanan/sktm')->group(function() {
    Route::get('/buat', 'ReqSktmController@create');
    Route::post('/buat', 'ReqSktmController@store');
    Route::get('/lihat/{id}', 'ReqSktmController@show');
    Route::get('/ubah/{id}', 'ReqSktmController@edit');
    Route::post('/update/{id}', 'ReqSktmController@update');
    Route::get('/batal/{id}', 'ReqSktmController@destroy');
});

Route::prefix('operator/sktm')->group(function() {
    Route::get('/lihat/{id}', 'ReqSktmAdminController@showPermohoanan');
    Route::get('/sesuai/{id}', 'ReqSktmAdminController@proses');
    Route::post('/tangguhkan/{id}', 'ReqSktmAdminController@tangguhkan');
    Route::post('/tolak/{id}', 'ReqSktmAdminController@tolak');
    Route::post('/updatepermohonan/{id}', 'ReqSktmAdminController@updatepermohonan');
    Route::get('/pdf/{id}/{service}', 'ReqSktmAdminController@pdf');
    Route::get('/verifikasi/{id}/', 'ReqSktmAdminController@verifikasi');
});

Route::prefix('tte/sktm')->group(function() {
    Route::get('/lihat/{id}', 'ReqSktmAdminController@showTTE');
    Route::post('/add/{id}', 'ReqSktmAdminController@addTTE');
});
