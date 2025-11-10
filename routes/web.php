<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\KelasController;


// Route utama kita arahkan ke daftar siswa
Route::get('/', [SiswaController::class, 'index'])->name('home');

// Routes untuk CRUD Kelas
Route::resource('kelas', KelasController::class);

// ✅ Soft Delete Routes (TARUH SEBELUM RESOURCE SISWA)
Route::get('/siswa/trash', [SiswaController::class, 'trash'])->name('siswa.trash');
Route::patch('/siswa/restore/{id}', [SiswaController::class, 'restore'])->name('siswa.restore');
Route::delete('/siswa/force-delete/{id}', [SiswaController::class, 'forceDelete'])->name('siswa.forceDelete');

// Routes untuk CRUD Siswa ✅ paling terakhir
Route::resource('siswa', SiswaController::class);
