<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SearchController;


// Route utama kita arahkan ke daftar siswa
Route::get('/', [SiswaController::class, 'index'])->name('home');

Route::get('/kelas', [KelasController::class, 'index'])->name('kelas.index');

Route::resource('kelas', KelasController::class);
Route::get('/search', SearchController::class)->name('search');

Route::get('/siswa/trash', [SiswaController::class, 'trash'])->name('siswa.trash');
Route::patch('/siswa/restore/{id}', [SiswaController::class, 'restore'])->name('siswa.restore');
Route::delete('/siswa/force-delete/{id}', [SiswaController::class, 'forceDelete'])->name('siswa.forceDelete');

Route::resource('siswa', SiswaController::class);
Route::get('/siswa/{id}', [SiswaController::class, 'details'])->name('siswa.details');
