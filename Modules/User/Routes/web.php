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

Route::prefix('user')->group(function() {
    Route::get('/', 'UserController@index');
    Route::get('pengaturan', 'UserController@setting');
    Route::post('pengaturan', 'UserController@changepassword');
    Route::get('profil', 'UserController@showProfile');
    Route::post('profil', 'UserController@updateProfile');
});

Route::prefix('user')->group(function() {
    Route::get('setting', 'UserAdminController@showSetting');
    Route::get('setting/password/{id}', 'UserAdminController@showSettingPassword');
    Route::get('setting/email/{id}', 'UserAdminController@showSettingEmail');
    Route::post('setting/changepassword', 'UserAdminController@settingPassword');
    Route::post('setting/changeemail', 'UserAdminController@settingEmail');
    Route::get('list', 'UserAdminController@listuser')->name('user.list');
});
