<?php

use Illuminate\Support\Facades\Route;

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

/* Landing */

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index']);
Route::get('/layanan', [\App\Http\Controllers\ServiceController::class, 'index']);
Route::get('/layanan/{slug}', [\App\Http\Controllers\ServiceController::class, 'show']);
Route::get('/verifikasi-dokumen', [\App\Http\Controllers\VerifyController::class, 'index']);
Route::get('/verifikasi-dokumen/hasil', [\App\Http\Controllers\VerifyController::class, 'result']);

Route::get('/pusat-bantuan', function () {
    return view('landing/help');
});
Route::get('/kontak-kami', function () {
    return view('landing/contact');
});
Route::get('/kebijakan-privasi', function () {
    return view('landing/privacy');
});

Route::get('/masuk', [\App\Http\Controllers\UserController::class, 'login'])->name('login');
Route::get('/backend', [\App\Http\Controllers\AdminController::class, 'backend'])->name('backend');
// Route::get('/daftar/selesai', function () { return view('auth/registersuccess'); });
// Route::get('/reset-sandi', function () { return view('auth/resetpassword'); });

Route::get('/404', function () {
    return view('errors/404');
});
Route::get('/500', function () {
    return view('errors/500');
});
Route::get('/419', function () {
    return view('errors/419');
});
/* End Landing */

/* User */
// Route::get('/user/beranda', function () { return view('users/dashboard'); });
// Route::get('/user/layanan', function () { return view('users/service'); });
Route::get('/user/layanan/buat', function () {
    return view('users/services/create');
});
Route::get('/user/layanan/buat-kelahiran', function () {
    return view('users/services/create-birth');
});
Route::get('/user/layanan/buat-kematian', function () {
    return view('users/services/create-die');
});
Route::get('/user/layanan/buat-keramaian', function () {
    return view('users/services/create-crowd');
});
Route::get('/user/layanan/buat-belum-menikah', function () {
    return view('users/services/create-not-married');
});
Route::get('/user/layanan/buat-belum-punya-rumah', function () {
    return view('users/services/create-not-have-house');
});
Route::get('/user/layanan/buat-ibadah-haji', function () {
    return view('users/services/create-hajj');
});
Route::get('/user/layanan/buat-janda-duda', function () {
    return view('users/services/create-widower');
});
Route::get('/user/layanan/buat-domisili-perusahaan', function () {
    return view('users/services/create-firm-address');
});
Route::get('/user/layanan/buat-pengantar-skck', function () {
    return view('users/services/create-police-records');
});
Route::get('/user/layanan/buat-bersih-diri', function () {
    return view('users/services/create-clean-self');
});
Route::get('/user/layanan/buat-mempunyai-usaha', function () {
    return view('users/services/create-have-business');
});
Route::get('/user/layanan/buat-andon-nikah', function () {
    return view('users/services/create-andon-married');
});
Route::get('/user/layanan/buat-tidak-mampu', function () {
    return view('users/services/create-needy');
});
Route::get('/user/layanan/buat-domisili', function () {
    return view('users/services/create-domicile');
});
Route::get('/user/layanan/detail', function () {
    return view('users/services/detail');
});
// Route::get('/user/pemberitahuan', function () { return view('users/notification'); });
Route::get('/user/bantuan', function () {
    return view('users/help');
});
// Route::get('/user/pengaturan', function () { return view('users/setting'); });
// Route::get('/user/profil', function () { return view('users/profile'); });
/* End User */

Route::post('/daftar/store', [\App\Http\Controllers\UserController::class, 'store']);
Route::get('/daftar/selesai/{id}', function () {
    return view('auth/registersuccess');
});
Route::get('/izinsso/selesai/{id}', function () {
    return view('auth/izinssosuccess');
});
Route::get('/kirim-ulang-email/{id}', [\App\Http\Controllers\UserController::class, 'resendEmail']);
Route::post('/masuk', [\App\Http\Controllers\UserController::class, 'authenticate']);
Route::post('/backend', [\App\Http\Controllers\AdminController::class, 'authenticate']);
Route::get('/logout', [\App\Http\Controllers\UserController::class, 'logout'])->middleware('auth');
Route::get('/logout-admin', [\App\Http\Controllers\AdminController::class, 'logout'])->middleware('auth:admin');
Route::get('user/activation/{nik}/{token}', [\App\Http\Controllers\UserController::class, 'activation']);
Route::get('/daftar', [\App\Http\Controllers\UserController::class, 'register']);
Route::get('/lupa-sandi', [\App\Http\Controllers\UserController::class, 'forgot']);
Route::post('/lupa-sandi', [\App\Http\Controllers\UserController::class, 'sendforgot']);
Route::get('/reset-sandi/{id}/{token}', [\App\Http\Controllers\UserController::class, 'reset']);
Route::post('/access/checking-account', [\App\Http\Controllers\UserController::class, 'checkniksso']);
Route::post('/reset-sandi', [\App\Http\Controllers\UserController::class, 'do_reset']);

//sso

// sso
Route::get('login-sso', [\App\Http\Controllers\SSOController::class, 'getUrlSSO'])->name('sso.login');
Route::get('/callback-sso',     [\App\Http\Controllers\SSOController::class, 'ssoCallback'])->name('sso.callback');
Route::get('/personal-info-sso', [\App\Http\Controllers\SSOController::class, 'connectUser'])->name('sso.connect');

// Route::middleware(['auth', 'verified', 'role:Superadmin'])->group(function () {
Route::get('user/services/form-detail/{request_id}', [\App\Http\Controllers\AdminController::class, 'showform']);
Route::post('user/services/form-detail', [\App\Http\Controllers\AdminController::class, 'storeform']);
// });


Route::get('/user/verification-permohonan/', [\App\Http\Controllers\UserController::class, 'showVerification'])->name('verification.permohonan');
Route::delete('/user/verification-permohonan/delete/{nip}', [\App\Http\Controllers\UserController::class, 'deleteVerification'])->name('verification.delete');
// Route::post('user/form-detail/submit', [App\Http\Controllers\UserController::class, 'submitForm'])->name('sumbit');

/* CMS Temporary */
Route::get('/cms', function () {
    return view('layouts/cms');
});
/* End CMS Temporary */

// crud verifikator
Route::post('/verifikator/add/{id}/{jenis}/{service}', [\App\Http\Controllers\VerifikatorController::class, 'storeverification']);
Route::get('/verifikator/del/{id}/{request}/{service}', [\App\Http\Controllers\VerifikatorController::class, 'deleteverification']);

// crud penandatangan
Route::post('/tte/edit/{id}/{request}/{service}', [\App\Http\Controllers\TTEController::class, 'ubah']);
