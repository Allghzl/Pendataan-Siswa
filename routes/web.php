<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\KelasController;


// Route utama kita arahkan ke daftar siswa
Route::get('/', [SiswaController::class, 'index'])->name('home');
// Routes untuk CRUD Kelas
Route::resource('kelas', KelasController::class);
// Routes untuk CRUD Siswa
Route::resource('siswa', SiswaController::class);
