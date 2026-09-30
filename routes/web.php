<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SesiPresensiController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\MahasiswaController;

Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard');


// =========================
// SESI PRESENSI
// =========================

Route::get('/sesi-presensi', [SesiPresensiController::class, 'index'])
    ->name('sesi-presensi.index');

Route::get('/sesi-presensi/create', [SesiPresensiController::class, 'create'])
    ->name('sesi-presensi.create');

Route::post('/sesi-presensi', [SesiPresensiController::class, 'store'])
    ->name('sesi-presensi.store');

Route::get('/sesi-presensi/{sesiPresensi}', [SesiPresensiController::class, 'show'])
    ->name('sesi-presensi.show');


// =========================
// PRESENSI MAHASISWA
// =========================

Route::get('/presensi/scan/{kodeQR}', [PresensiController::class, 'scan'])
    ->name('presensi.scan');

Route::post('/presensi/scan/{kodeQR}', [PresensiController::class, 'store'])
    ->name('presensi.store');


// =========================
// REKAP PRESENSI
// =========================

Route::get('/sesi-presensi/{sesiPresensi}/rekap', [PresensiController::class, 'rekap'])
    ->name('presensi.rekap');


// =========================
// IMPORT MAHASISWA
// =========================

Route::get('/mahasiswa/import', [MahasiswaController::class, 'showImportForm'])
    ->name('mahasiswa.import.form');

Route::post('/mahasiswa/import', [MahasiswaController::class, 'import'])
    ->name('mahasiswa.import');

    Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');