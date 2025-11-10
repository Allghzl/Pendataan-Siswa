<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\KelasController;


// Route utama kita arahkan ke daftar siswa
Route::get('/', [SiswaController::class, 'index'])->name('home');
<<<<<<< HEAD
=======
Route::get('/kelas', [KelasController::class, 'index'])->name('kelas.index');
>>>>>>> 9a1430e353f4b4b3b7c12320b47b00aa5b6d751c

// Routes untuk CRUD Kelas
Route::resource('kelas', KelasController::class);

<<<<<<< HEAD
// ✅ Soft Delete Routes (TARUH SEBELUM RESOURCE SISWA)
Route::get('/siswa/trash', [SiswaController::class, 'trash'])->name('siswa.trash');
Route::patch('/siswa/restore/{id}', [SiswaController::class, 'restore'])->name('siswa.restore');
Route::delete('/siswa/force-delete/{id}', [SiswaController::class, 'forceDelete'])->name('siswa.forceDelete');

// Routes untuk CRUD Siswa ✅ paling terakhir
=======
// Routes untuk CRUD Siswa
>>>>>>> 9a1430e353f4b4b3b7c12320b47b00aa5b6d751c
Route::resource('siswa', SiswaController::class);
Route::get('/siswa/{id}', [SiswaController::class, 'details'])->name('siswa.details');
