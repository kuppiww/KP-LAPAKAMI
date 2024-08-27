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

Route::prefix('verifikator')->group(function() {
    Route::get('/', 'VerifikatorController@index');
    Route::get('/list', 'VerifikatorController@listpermohonan')->name('verifikator.list');
    Route::get('/detail/{id}/{service_id}', 'VerifikatorController@show');
});
