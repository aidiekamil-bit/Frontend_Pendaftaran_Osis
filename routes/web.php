<?php

use App\Http\Controllers\PendaftaranFrontendController;
use Illuminate\Support\Facades\Route;

// Halaman utama (Root) langsung menampilkan daftar pendaftaran OSIS
Route::get('/', [PendaftaranFrontendController::class, 'index'])->name('pendaftaran.index');

// Opsional: Alias URL /pendaftaran-osis agar mengarah ke index yang sama (mencegah error 404 jika ada link lama)
Route::get('/pendaftaran-osis', [PendaftaranFrontendController::class, 'index']);

// Rute CRUD Pendaftaran OSIS
Route::get('/pendaftaran-osis/create', [PendaftaranFrontendController::class, 'create'])->name('pendaftaran.create');
Route::post('/pendaftaran-osis', [PendaftaranFrontendController::class, 'store'])->name('pendaftaran.store');
Route::get('/pendaftaran-osis/{id}/edit', [PendaftaranFrontendController::class, 'edit'])->name('pendaftaran.edit');
Route::put('/pendaftaran-osis/{id}', [PendaftaranFrontendController::class, 'update'])->name('pendaftaran.update');
Route::delete('/pendaftaran-osis/{id}', [PendaftaranFrontendController::class, 'destroy'])->name('pendaftaran.destroy');