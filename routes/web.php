<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
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

// Route::get('/', [\App\Http\Controllers\FrontPageController::class, 'welcome'])->name('landing');
Route::get('/', [AuthenticatedSessionController::class, 'create'])->name('landing');

Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.', 'middleware' => 'auth'], function() {
    Route::get('/', [\App\Http\Controllers\DashboardController::class, 'index'])->name('index');

    Route::get('user/profile', [\App\Http\Controllers\UserController::class, 'profile'])->name('user.profile');
    Route::put('user/profile_update', [\App\Http\Controllers\UserController::class, 'profile_update'])->name('user.profile_update');

    // Master Data
    Route::resource('user', \App\Http\Controllers\UserController::class)->except('show');
    Route::resource('aset', \App\Http\Controllers\AsetController::class)->except('show');
    Route::resource('jadwal_aset', \App\Http\Controllers\JadwalAsetController::class)->except('show');

    // Transaksi Routes
    Route::post('booking/scan_tiket', [\App\Http\Controllers\BookingController::class, 'scan_tiket_process'])->name('booking.scan_tiket_process');
    Route::get('booking/scan_tiket', [\App\Http\Controllers\BookingController::class, 'scan_tiket'])->name('booking.scan_tiket');
    Route::resource('booking', \App\Http\Controllers\BookingController::class);
    Route::get('booking/komplen/{id}', [\App\Http\Controllers\BookingController::class, 'komplen'])->name('booking.komplen');
    Route::put('booking/komplen/{id}', [\App\Http\Controllers\BookingController::class, 'komplen_store'])->name('booking.komplen_store');
    Route::get('booking/bukti_bayar/{id}', [\App\Http\Controllers\BookingController::class, 'bukti_bayar'])->name('booking.bukti_bayar');
    Route::put('booking/bukti_bayar/{id}', [\App\Http\Controllers\BookingController::class, 'bukti_bayar_store'])->name('booking.bukti_bayar_store');
    Route::put('booking/set_paid/{id}', [\App\Http\Controllers\BookingController::class, 'set_paid'])->name('booking.set_paid');
    Route::put('booking/set_used/{id}', [\App\Http\Controllers\BookingController::class, 'set_used'])->name('booking.set_used');

    Route::get('gis_aset', [\App\Http\Controllers\BookingController::class, 'gis_aset'])->name('gis_aset');
    Route::get('booking/create/{id}', [\App\Http\Controllers\BookingController::class, 'create'])->name('booking.create');
    Route::post('booking/store', [\App\Http\Controllers\BookingController::class, 'store'])->name('booking.store');

    // Laporan Routes
    Route::get('laporan/periode', [\App\Http\Controllers\LaporanController::class, 'periode'])->name('laporan.periode');
    Route::get('laporan/keuangan', [\App\Http\Controllers\LaporanController::class, 'keuangan'])->name('laporan.keuangan');

});

require __DIR__.'/auth.php';
