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

Route::prefix('/user/pemberitahuan')->group(function() {
    Route::get('/', 'NotificationController@index');
    Route::get('/baca/{id}', 'NotificationController@edit');
});
