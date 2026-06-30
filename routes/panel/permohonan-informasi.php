<?php


use App\Http\Controllers\Panel\PermohonanInformasiController;
use Illuminate\Support\Facades\Route;

// ─── Permohonan Informasi ─────────────────────────────────────────────────────
Route::prefix('permohonan_informasi')->group(function () {
    Route::middleware(['rbac:permohonan_informasi,1'])->group(function () {
        Route::get('/', [PermohonanInformasiController::class, 'list'])->name('permohonan_informasi');
        Route::get('/data', [PermohonanInformasiController::class, 'datatable'])->name('permohonan_informasi.data');
        Route::get('/edit/{id}', [PermohonanInformasiController::class, 'edit'])->name('permohonan_informasi.edit');
    });
    Route::middleware(['rbac:permohonan_informasi,2'])->group(function () {
        Route::post('/store', [PermohonanInformasiController::class, 'store'])->name('permohonan_informasi.store');
    });
    Route::middleware(['rbac:permohonan_informasi,3'])->group(function () {
        Route::patch('/update', [PermohonanInformasiController::class, 'update'])->name('permohonan_informasi.update');
    });
    Route::middleware(['rbac:permohonan_informasi,4'])->group(function () {
        Route::delete('/delete', [PermohonanInformasiController::class, 'delete'])->name('permohonan_informasi.delete');
    });
});


?>
