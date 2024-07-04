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

Route::prefix('cms/layanan')->group(function() {
    Route::get('/', 'CmsServiceController@index');
    Route::post('/store', 'CmsServiceController@store');
    Route::post('/update/{id}', 'CmsServiceController@update');
    Route::get('/delete/{id}', 'CmsServiceController@destroy');
    Route::get('/getdata/{id}', 'CmsServiceController@getdata');
    Route::get('/detail/{id}', 'CmsServiceController@detail');
});

Route::prefix('cms/layanan_syarat')->group(function() {
    Route::post('/store', 'CmsServiceController@store_requirement');
    Route::post('/update/{id}', 'CmsServiceController@update_requirement');
    Route::get('/delete/{id}', 'CmsServiceController@destroy_requirement');
    Route::get('/getdata/{id}', 'CmsServiceController@getdata_requirement');
});

Route::get('/cms/monitoring-layanan', 'CmsServiceController@monitoringlayanan');
Route::get('/cms/monitoring-layanan/success', 'CmsServiceController@monitoringlayanansuccess');
