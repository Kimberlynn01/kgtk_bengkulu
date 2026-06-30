<?php

use App\Http\Controllers\Panel\PermohonanSaranaPrasaranaController;
use Illuminate\Support\Facades\Route;


// ─── Permohonan Sarana & Prasarana ───────────────────────────────────────────
Route::prefix('permohonan_sarana_prasarana')->group(function () {
    Route::middleware(['rbac:permohonan_sarana_prasarana,1'])->group(function () {
        Route::get('/', [PermohonanSaranaPrasaranaController::class, 'list'])->name('permohonan_sarana_prasarana');
        Route::get('/data', [PermohonanSaranaPrasaranaController::class, 'datatable'])->name('permohonan_sarana_prasarana.data');
        Route::get('/edit/{id}', [PermohonanSaranaPrasaranaController::class, 'edit'])->name('permohonan_sarana_prasarana.edit');
    });
    Route::middleware(['rbac:permohonan_sarana_prasarana,2'])->group(function () {
        Route::post('/store', [PermohonanSaranaPrasaranaController::class, 'store'])->name('permohonan_sarana_prasarana.store');
    });
    Route::middleware(['rbac:permohonan_sarana_prasarana,3'])->group(function () {
        Route::patch('/update', [PermohonanSaranaPrasaranaController::class, 'update'])->name('permohonan_sarana_prasarana.update');
    });
    Route::middleware(['rbac:permohonan_sarana_prasarana,4'])->group(function () {
        Route::delete('/delete', [PermohonanSaranaPrasaranaController::class, 'delete'])->name('permohonan_sarana_prasarana.delete');
    });
});
