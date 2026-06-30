<?php

    
use App\Http\Controllers\Panel\PermohonanNarasumberController;
use Illuminate\Support\Facades\Route;


// ─── Permohonan Narasumber ────────────────────────────────────────────────────
Route::prefix('permohonan_narasumber')->group(function () {
    Route::middleware(['rbac:permohonan_narasumber,1'])->group(function () {
        Route::get('/', [PermohonanNarasumberController::class, 'list'])->name('permohonan_narasumber');
        Route::get('/data', [PermohonanNarasumberController::class, 'datatable'])->name('permohonan_narasumber.data');
        Route::get('/edit/{id}', [PermohonanNarasumberController::class, 'edit'])->name('permohonan_narasumber.edit');
    });
    Route::middleware(['rbac:permohonan_narasumber,2'])->group(function () {
        Route::post('/store', [PermohonanNarasumberController::class, 'store'])->name('permohonan_narasumber.store');
    });
    Route::middleware(['rbac:permohonan_narasumber,3'])->group(function () {
        Route::patch('/update', [PermohonanNarasumberController::class, 'update'])->name('permohonan_narasumber.update');
    });
    Route::middleware(['rbac:permohonan_narasumber,4'])->group(function () {
        Route::delete('/delete', [PermohonanNarasumberController::class, 'delete'])->name('permohonan_narasumber.delete');
    });
});

?>