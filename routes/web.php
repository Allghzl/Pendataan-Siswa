<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\KelasController;

Route::get('/header', function () {
    return view('layout.header'); // sementara redirect ke header
});

// // =====================
// // ROUTE SISWA (CRUD)
// // =====================
// Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.index');
// Route::get('/siswa/create', [SiswaController::class, 'create'])->name('siswa.create');
// Route::post('/siswa', [SiswaController::class, 'store'])->name('siswa.store');
// Route::get('/siswa/{id}', [SiswaController::class, 'show'])->name('siswa.show');
// Route::get('/siswa/{id}/edit', [SiswaController::class, 'edit'])->name('siswa.edit');
// Route::put('/siswa/{id}', [SiswaController::class, 'update'])->name('siswa.update');
// Route::delete('/siswa/{id}', [SiswaController::class, 'destroy'])->name('siswa.delete');

// // =====================
// // ROUTE KELAS (CRUD)
// // =====================
// Route::get('/kelas', [KelasController::class, 'index'])->name('kelas.index');
// Route::get('/kelas/create', [KelasController::class, 'create'])->name('kelas.create');
// Route::post('/kelas', [KelasController::class, 'store'])->name('kelas.store');
// Route::get('/kelas/{id}', [KelasController::class, 'show'])->name('kelas.show');
// Route::get('/kelas/{id}/edit', [KelasController::class, 'edit'])->name('kelas.edit');
// Route::put('/kelas/{id}', [KelasController::class, 'update'])->name('kelas.update');
// Route::delete('/kelas/{id}', [KelasController::class, 'destroy'])->name('kelas.delete');
