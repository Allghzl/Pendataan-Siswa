<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\KelasController;


// Route utama kita arahkan ke daftar siswa
Route::get('/', [SiswaController::class, 'index'])->name('home');
Route::get('/kelas', [KelasController::class, 'index'])->name('kelas.index');

// Routes untuk CRUD Kelas
Route::resource('kelas', KelasController::class);

// Routes untuk CRUD Siswa
Route::resource('siswa', SiswaController::class);
Route::get('/siswa/{id}', [SiswaController::class, 'details'])->name('siswa.details');
