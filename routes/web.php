<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SearchController;

// Home → Daftar siswa
Route::get('/', [SiswaController::class, 'index'])->name('home');

Route::get('/kelas', [KelasController::class, 'index'])->name('kelas.index');

Route::resource('kelas', KelasController::class);
Route::get('/search', SearchController::class)->name('search');

// Soft Delete Siswa
Route::get('/siswa/trash', [SiswaController::class, 'trash'])->name('siswa.trash');
Route::patch('/siswa/restore/{id}', [SiswaController::class, 'restore'])->name('siswa.restore');
Route::delete('/siswa/force-delete/{id}', [SiswaController::class, 'forceDelete'])->name('siswa.forceDelete');

// Soft Delete Kelas
Route::get('/kelas/trash', [KelasController::class, 'trash'])->name('kelas.trash');
Route::patch('/kelas/restore/{id}', [KelasController::class, 'restore'])->name('kelas.restore');
Route::delete('/kelas/forceDelete/{id}', [KelasController::class, 'forceDelete'])->name('kelas.forceDelete');

// Resource Routes (bikin semua CRUD)
Route::resource('siswa', SiswaController::class);
Route::resource('kelas', KelasController::class);
