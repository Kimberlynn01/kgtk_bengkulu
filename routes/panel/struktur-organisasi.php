<?php 


use App\Http\Controllers\Panel\StrukturOrganisasiController;
use Illuminate\Support\Facades\Route;

// ─── Struktur Organisasi ──────────────────────────────────────────────────────
Route::prefix('struktur_organisasi')->group(function () {
    Route::middleware(['rbac:struktur_organisasi,1'])->group(function () {
        Route::get('/', [StrukturOrganisasiController::class, 'list'])->name('struktur_organisasi');
        Route::get('/data', [StrukturOrganisasiController::class, 'datatable'])->name('struktur_organisasi.data');
        Route::get('/edit/{id}', [StrukturOrganisasiController::class, 'edit'])->name('struktur_organisasi.edit');
    });
    Route::middleware(['rbac:struktur_organisasi,2'])->group(function () {
        Route::post('/store', [StrukturOrganisasiController::class, 'store'])->name('struktur_organisasi.store');
    });
    Route::middleware(['rbac:struktur_organisasi,3'])->group(function () {
        Route::patch('/update', [StrukturOrganisasiController::class, 'update'])->name('struktur_organisasi.update');
    });
    Route::middleware(['rbac:struktur_organisasi,4'])->group(function () {
        Route::delete('/delete', [StrukturOrganisasiController::class, 'delete'])->name('struktur_organisasi.delete');
    });
});




?>