<?php

use App\Http\Controllers\Panel\JanjiMaklumatController;
use App\Http\Controllers\Panel\ProfilPejabatController;
use App\Http\Controllers\Panel\TimKerjaController;
use App\Http\Controllers\Panel\TugasFungsiController;
use App\Http\Controllers\Panel\VisiMisiController;
use App\Models\TugasFungsi;
use Illuminate\Support\Facades\Route;


Route::prefix('visi-misi')->group(function() {
    Route::get('/', [VisiMisiController::class, 'show']);
});

Route::prefix('tugas-fungsi')->group(function() {
    Route::get('/', [TugasFungsiController::class, 'show']);
});

Route::prefix('tim-kerja')->group(function() {
    Route::get('/', [TimKerjaController::class, 'show']);
});

Route::prefix('janji-layanan')->group(function() {
    Route::get('/', [JanjiMaklumatController::class, 'show']);
});

Route::prefix('pejabat-struktural')->group(function() {
    Route::get('/', [ProfilPejabatController::class, 'show']);
});
