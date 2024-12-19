<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterAdminController;
use App\Http\Controllers\Auth\LoginAdminController;
use App\Http\Controllers\Auth\LoginDokterController;
use App\Http\Controllers\Auth\LoginPasienController;
use App\Http\Controllers\Auth\RegisterDokterController;
use App\Http\Controllers\Auth\RegisterPasienController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\HasilPeriksaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\ReservasiController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//landingpage
Route::get('/admin', [AdminController::class, 'index'])->name('homeadmin');
Route::get('/dokter', [DokterController::class, 'index'])->name('homedokter');

Route::get('/', [PasienController::class, 'index'])->name('home');
Route::get('/about', [PasienController::class, 'showAbout'])->name('about');
Route::get('/contact', [PasienController::class, 'showContact'])->name('contact');

//register dan login
Route::middleware(['guest'])->group(function () {
    Route::get('register/admin', [RegisterAdminController::class, 'showRegistrationForm'])
        ->name('register.admin')
        ->middleware('check.admin');
    Route::get('register/dokter', [RegisterDokterController::class, 'showRegistrationForm'])
        ->name('register.dokter')
        ->middleware('check.dokter');
    Route::get('register/pasien', [RegisterPasienController::class, 'showRegistrationForm'])
        ->name('register.pasien')
        ->middleware('check.pasien');
    Route::post('register/admin', [RegisterAdminController::class, 'register']);
    Route::post('register/dokter', [RegisterDokterController::class, 'register']);
    Route::post('register/pasien', [RegisterPasienController::class, 'register']);
    
    Route::get('login/admin', [LoginAdminController::class, 'showLoginForm'])
        ->name('login.admin')
        ->middleware('check.admin');
    Route::post('login/admin', [LoginAdminController::class, 'login']);
    Route::get('login/dokter', [LoginDokterController::class, 'showLoginForm'])
        ->name('login.dokter')
        ->middleware('check.dokter');
    Route::post('login/dokter', [LoginDokterController::class, 'login']);
    Route::get('login/pasien', [LoginPasienController::class, 'showLoginForm'])
        ->name('login.pasien')
        ->middleware('check.pasien');
    Route::post('login/pasien', [LoginPasienController::class, 'login']);
});

//logout
Route::post('pasien/logout', [LoginPasienController::class, 'logout'])
    ->name('pasien.logout');
Route::post('admin/logout', [LoginAdminController::class, 'logout'])
    ->name('admin.logout');
Route::post('dokter/logout', [LoginDokterController::class, 'logout'])
    ->name('dokter.logout');

//Pasien
Route::middleware(['auth', 'check.pasien'])->group(function () {
    Route::get('pasien/dashboard', [PasienController::class, 'showDashboard'])
        ->name('pasienDashboard');
    
    Route::get('pasien/get-dokter', [ReservasiController::class, 'getDokterByPoli'])->name('pasien.get.dokter');
    Route::post('pasien/reservasi-create', [ReservasiController::class, 'createReservasi'])->name('create-reservasi-pasien');
    Route::get('pasien/get-reservasi-today', [ReservasiController::class, 'getReservasiTodayPasien'])->name('pasien.get.reservasi.hari_ini');
    Route::delete('pasien/reservasi-delete', [ReservasiController::class, 'destroy'])->name('pasien.delete.reservasi');
    Route::get('pasien/{pasienId}/riwayat', [ReservasiController::class, 'riwayatPemeriksaanInPasien'])->name('riwayat.periksa.pasien');
    Route::get('pasien/edit-pasien/{id}', [PasienController::class, 'updatePasienShow'])
        ->name('updateDataShow');
    Route::put('pasien/update-pasien/{id}', [PasienController::class, 'updatePasien'])
        ->name('updateDataPasien');
});

//Admin
Route::middleware(['auth', 'check.admin'])->group(function () {
    Route::get('admin/dashboard', [AdminController::class, 'showDashboard'])
        -> name('adminDashboard');
    //pasien
    Route::get('admin/pasien', [AdminController::class, 'readPasien'])
        ->name('adminPasienShow');
    Route::get('admin/pasien-create', [AdminController::class, 'createPasienShow'])
        ->name('adminPasienCreate');
    Route::post('admin/pasien-create', [AdminController::class, 'createPasien'])
        ->name('create-pasien');
    Route::delete('delete-pasien/{id}', [AdminController::class, 'destroyPasien'])
        ->name('delete-pasien');
    Route::get('edit-pasien/{id}', [AdminController::class, 'updatePasienShow'])
        ->name('updatePasienShow');
    Route::put('update-pasien/{id}', [AdminController::class, 'updatePasien'])
        ->name('updatePasien');
    Route::get('pasien/search', [ReservasiController::class, 'getSearchPasienInAdmin'])
        ->name('search.pasien.admin');

    //dokter
    Route::get('admin/dokter', [AdminController::class, 'readDokter'])
        ->name('adminDokterShow');
    Route::post('admin/dokter-create', [AdminController::class, 'createDokter'])
        ->name('create-dokter');
    Route::delete('delete-dokter/{id}', [AdminController::class, 'destroyDokter'])
        ->name('delete-dokter');
    Route::get('edit-dokter/{id}', [AdminController::class, 'updateDokterShow'])
        ->name('updateDokterShow');
    Route::put('update-dokter{id}', [DokterController::class, 'updateDokter'])
        ->name('updateDokter');
    //reservasi
    Route::get('admin/get-dokter', [ReservasiController::class, 'getDokterByPoli'])
        ->name('admin.get.dokter');
    Route::get('admin/search-pasien', [AdminController::class, 'searchPasien'])
        ->name('admin.search.pasien');
    Route::post('admin/reservasi-create', [ReservasiController::class, 'createReservasi'])
        ->name('create-reservasi');
    Route::get('admin/get-reservasi-today', [ReservasiController::class, 'getReservasiToday'])
        ->name('admin.get.reservasi.hari_ini');
    Route::post('admin/update-status-reservasi', [AdminController::class, 'updateStatusReservasi'])
        ->name('admin.update.status.reservasi');
    Route::delete('admin/delete-reservasi', [ReservasiController::class, 'deleteReservasi'])
        ->name('admin.delete.reservasi');
    Route::get('admin/get-history',[ReservasiController::class, 'getHistory'])
        ->name('getHistory');
    Route::get('admin/{pasienId}/riwayat', [ReservasiController::class, 'riwayatPemeriksaan'])
        ->name('riwayat.periksa');
    Route::get('/admin/pasien/search', [ReservasiController::class, 'getSearchPasien'])
        ->name('search.pasien');

});

//Dokter
Route::middleware(['auth', 'check.dokter'])->group(function(){
    Route::get('dokter/dashboard', [DokterController::class, 'showDashboard'])
        -> name('dokterDashboard');
    Route::post('dokter/tambah-hasil', [HasilPeriksaController::class, 'store'])
        ->name('tambah.hasil');
    Route::post('dokter/update-status-reservasi', [DokterController::class, 'updateStatusReservasi'])
        ->name('dokter.update.status.reservasi');
    Route::get('dokter/riwayat-hasil/{pasienId}', [DokterController::class, 'showRiwayatHasil'])
        ->name('riwayatHasil');
    Route::post('/dokter/update-hasil', [DokterController::class, 'updateHasilPeriksa'])
        ->name('dokter.update.hasil');  
    Route::get('dokter/get-history', [ReservasiController::class, 'getHistoryInDokter'])
        ->name('getHistoryInDokter');
    Route::get('dokter/{pasienId}/riwayat', [ReservasiController::class, 'riwayatPemeriksaanInDokter'])
        ->name('riwayat.periksa.dokter');
    Route::get('dokter/pasien/search', [ReservasiController::class, 'getSearchPasienInDokter'])
        ->name('search.pasien.dokter');
    Route::get('/dokter/daftar-pasien', [DokterController::class, 'daftarPasien'])
        ->name('dokter.daftar.pasien');
    Route::get('dokter/edit-dokter/{id}', [DokterController::class, 'updateDokterShow'])
        ->name('editProfilShow');
    Route::put('dokter/update-profil/{id}', [DokterController::class, 'updateDokter'])
        ->name('updateProfil');
});







// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('/');
