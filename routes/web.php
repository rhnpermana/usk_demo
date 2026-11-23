<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SekolahController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', [SekolahController::class, 'dashboard'])->name('dashboard');

// Guru
Route::get('/guru', [SekolahController::class, 'indexGuru'])->name('guru.index');
Route::post('/guru', [SekolahController::class, 'storeGuru'])->name('guru.store');
Route::put('/guru/{nip}', [SekolahController::class, 'updateGuru'])->name('guru.update');
Route::delete('/guru/{nip}', [SekolahController::class, 'destroyGuru'])->name('guru.destroy');

// Siswa
Route::get('/siswa', [SekolahController::class, 'indexSiswa'])->name('siswa.index');
Route::post('/siswa', [SekolahController::class, 'storeSiswa'])->name('siswa.store');
Route::put('/siswa/{nis}', [SekolahController::class, 'updateSiswa'])->name('siswa.update');
Route::delete('/siswa/{nis}', [SekolahController::class, 'destroySiswa'])->name('siswa.destroy');

// Mapel
Route::get('/mapel', [SekolahController::class, 'indexMapel'])->name('mapel.index');
Route::post('/mapel', [SekolahController::class, 'storeMapel'])->name('mapel.store');
Route::put('/mapel/{id}', [SekolahController::class, 'updateMapel'])->name('mapel.update');
Route::delete('/mapel/{id}', [SekolahController::class, 'destroyMapel'])->name('mapel.destroy');

// Setting Guru Mapel
Route::get('/guru-mapel', [SekolahController::class, 'indexGuruMapel'])->name('guru-mapel.index');
Route::post('/guru-mapel', [SekolahController::class, 'storeGuruMapel'])->name('guru-mapel.store');
Route::put('/guru-mapel/{id}', [SekolahController::class, 'updateGuruMapel'])->name('guru-mapel.update');
Route::delete('/guru-mapel/{id}', [SekolahController::class, 'destroyGuruMapel'])->name('guru-mapel.destroy');

// Nilai
Route::get('/nilai', [SekolahController::class, 'indexNilai'])->name('nilai.index');
Route::post('/nilai', [SekolahController::class, 'storeNilai'])->name('nilai.store');
Route::put('/nilai/{id}', [SekolahController::class, 'updateNilai'])->name('nilai.update');
Route::delete('/nilai/{id}', [SekolahController::class, 'destroyNilai'])->name('nilai.destroy');