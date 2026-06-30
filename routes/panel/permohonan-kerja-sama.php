<?php

use App\Http\Controllers\Panel\PermohonanKerjaSamaController;
use Illuminate\Support\Facades\Route;

// ─── Permohonan Kerja Sama ────────────────────────────────────────────────────
Route::prefix('permohonan_kerja_sama')->group(function () {
    Route::middleware(['rbac:permohonan_kerja_sama,1'])->group(function () {
        Route::get('/', [PermohonanKerjaSamaController::class, 'list'])->name('permohonan_kerja_sama');
        Route::get('/data', [PermohonanKerjaSamaController::class, 'datatable'])->name('permohonan_kerja_sama.data');
        Route::get('/edit/{id}', [PermohonanKerjaSamaController::class, 'edit'])->name('permohonan_kerja_sama.edit');
    });
    Route::middleware(['rbac:permohonan_kerja_sama,2'])->group(function () {
        Route::post('/store', [PermohonanKerjaSamaController::class, 'store'])->name('permohonan_kerja_sama.store');
    });
    Route::middleware(['rbac:permohonan_kerja_sama,3'])->group(function () {
        Route::patch('/update', [PermohonanKerjaSamaController::class, 'update'])->name('permohonan_kerja_sama.update');
    });
    Route::middleware(['rbac:permohonan_kerja_sama,4'])->group(function () {
        Route::delete('/delete', [PermohonanKerjaSamaController::class, 'delete'])->name('permohonan_kerja_sama.delete');
    });
});


?>