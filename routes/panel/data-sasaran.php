<?php

use App\Http\Controllers\Panel\DataSasaranController;
use Illuminate\Support\Facades\Route;

// ─── Data Sasaran ─────────────────────────────────────────────────────────────
Route::prefix('data_sasaran')->group(function () {
    Route::middleware(['rbac:data_sasaran,1'])->group(function () {
        Route::get('/', [DataSasaranController::class, 'list'])->name('data_sasaran');
        Route::get('/data', [DataSasaranController::class, 'datatable'])->name('data_sasaran.data');
        Route::get('/edit/{id}', [DataSasaranController::class, 'edit'])->name('data_sasaran.edit');
    });
    Route::middleware(['rbac:data_sasaran,2'])->group(function () {
        Route::post('/store', [DataSasaranController::class, 'store'])->name('data_sasaran.store');
    });
    Route::middleware(['rbac:data_sasaran,3'])->group(function () {
        Route::patch('/update', [DataSasaranController::class, 'update'])->name('data_sasaran.update');
    });
    Route::middleware(['rbac:data_sasaran,4'])->group(function () {
        Route::delete('/delete', [DataSasaranController::class, 'delete'])->name('data_sasaran.delete');
    });
});


?>