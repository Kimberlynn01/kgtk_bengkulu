<?php

use App\Http\Controllers\Panel\InformasiProgramController;
use App\Http\Controllers\Panel\KemitraanController;
use Illuminate\Support\Facades\Route;

Route::prefix('informasi_program')->group(function () {
    Route::middleware(['rbac:informasi_program,1'])->group(function () {
        Route::get('/', [InformasiProgramController::class, 'list'])->name('informasi_program');
        Route::get('/data', [InformasiProgramController::class, 'datatable'])->name('informasi_program.data');
        Route::get('/edit/{id}', [InformasiProgramController::class, 'edit'])->name('informasi_program.edit');
    });

    Route::middleware(['rbac:informasi_program,2'])->group(function () {
        Route::post('/store', [InformasiProgramController::class, 'store'])->name('informasi_program.store');
    });

    Route::middleware(['rbac:informasi_program,3'])->group(function () {
        Route::patch('/update', [InformasiProgramController::class, 'update'])->name('informasi_program.update');
    });

    Route::middleware(['rbac:informasi_program,4'])->group(function () {
        Route::delete('/delete', [InformasiProgramController::class, 'delete'])->name('informasi_program.delete');
    });
});

Route::prefix('kemitraan')->group(function () {
    Route::middleware(['rbac:kemitraan,1'])->group(function () {
        Route::get('/', [KemitraanController::class, 'list'])->name('kemitraan');
        Route::get('/data', [KemitraanController::class, 'datatable'])->name('kemitraan.data');
        Route::get('/edit/{id}', [KemitraanController::class, 'edit'])->name('kemitraan.edit');
    });

    Route::middleware(['rbac:kemitraan,2'])->group(function () {
        Route::post('/store', [KemitraanController::class, 'store'])->name('kemitraan.store');
    });

    Route::middleware(['rbac:kemitraan,3'])->group(function () {
        Route::patch('/update', [KemitraanController::class, 'update'])->name('kemitraan.update');
    });

    Route::middleware(['rbac:kemitraan,4'])->group(function () {
        Route::delete('/delete', [KemitraanController::class, 'delete'])->name('kemitraan.delete');
    });
});
