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

Route::prefix('user/layanan/domisili-perusahaan')->group(function() {
    Route::get('/buat', 'ReqDomicileCompanyController@create');
    Route::post('/buat', 'ReqDomicileCompanyController@store');
    Route::get('/lihat/{id}', 'ReqDomicileCompanyController@show');
    Route::get('/ubah/{id}', 'ReqDomicileCompanyController@edit');
    Route::post('/update/{id}', 'ReqDomicileCompanyController@update');
    Route::get('/batal/{id}', 'ReqDomicileCompanyController@destroy');
});