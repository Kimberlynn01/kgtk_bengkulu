<?php

use App\Http\Controllers\Panel\InformasiProgramController;
use Illuminate\Support\Facades\Route;

Route::prefix('informasi-program')->group(function () {

    Route::middleware(['rbac:informasi_program,1'])->group(function () {
        Route::get('/', [InformasiProgramController::class, 'list'])->name('informasi-program');
        Route::get('/data', [InformasiProgramController::class, 'datatable'])->name('informasi-program.data');
        Route::get('/edit/{id}', [InformasiProgramController::class, 'edit'])->name('informasi-program.edit');
    });

    Route::middleware(['rbac:informasi_program,2'])->group(function () {
        Route::post('/store', [InformasiProgramController::class, 'store'])->name('informasi-program.store');
    });

    Route::middleware(['rbac:informasi_program,3'])->group(function () {
        Route::patch('/update', [InformasiProgramController::class, 'update'])->name('informasi-program.update');
    });

    Route::middleware(['rbac:informasi_program,4'])->group(function () {
        Route::delete('/delete', [InformasiProgramController::class, 'delete'])->name('informasi-program.delete');
    });

});
