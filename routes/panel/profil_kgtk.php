<?php

use App\Http\Controllers\Panel\VisiMisiController;
use App\Http\Controllers\Panel\TugasFungsiController;
use App\Http\Controllers\Panel\TimKerjaController;
use App\Http\Controllers\Panel\JanjiMaklumatController;
use App\Http\Controllers\Panel\ProfilPejabatController;
use Illuminate\Support\Facades\Route;

Route::prefix('visi_misi')->group(function () {
    Route::middleware(['rbac:visi_misi,1'])->group(function () {
        Route::get('/', [VisiMisiController::class, 'list'])->name('visi_misi');
        Route::get('/data', [VisiMisiController::class, 'datatable'])->name('visi_misi.data');
        Route::get('/edit/{id}', [VisiMisiController::class, 'edit'])->name('visi_misi.edit');
    });

    Route::middleware(['rbac:visi_misi,2'])->group(function () {
        Route::post('/store', [VisiMisiController::class, 'store'])->name('visi_misi.store');
    });

    Route::middleware(['rbac:visi_misi,3'])->group(function () {
        Route::patch('/update', [VisiMisiController::class, 'update'])->name('visi_misi.update');
    });

    Route::middleware(['rbac:visi_misi,4'])->group(function () {
        Route::delete('/delete', [VisiMisiController::class, 'delete'])->name('visi_misi.delete');
    });
});

Route::prefix('tugas_fungsi')->group(function () {
    Route::middleware(['rbac:tugas_fungsi,1'])->group(function () {
        Route::get('/', [TugasFungsiController::class, 'list'])->name('tugas_fungsi');
        Route::get('/data', [TugasFungsiController::class, 'datatable'])->name('tugas_fungsi.data');
        Route::get('/edit/{id}', [TugasFungsiController::class, 'edit'])->name('tugas_fungsi.edit');
    });

    Route::middleware(['rbac:tugas_fungsi,2'])->group(function () {
        Route::post('/store', [TugasFungsiController::class, 'store'])->name('tugas_fungsi.store');
    });

    Route::middleware(['rbac:tugas_fungsi,3'])->group(function () {
        Route::patch('/update', [TugasFungsiController::class, 'update'])->name('tugas_fungsi.update');
    });

    Route::middleware(['rbac:tugas_fungsi,4'])->group(function () {
        Route::delete('/delete', [TugasFungsiController::class, 'delete'])->name('tugas_fungsi.delete');
    });
});

Route::prefix('tim_kerja')->group(function () {
    Route::middleware(['rbac:tim_kerja,1'])->group(function () {
        Route::get('/', [TimKerjaController::class, 'list'])->name('tim_kerja');
        Route::get('/data', [TimKerjaController::class, 'datatable'])->name('tim_kerja.data');
        Route::get('/edit/{id}', [TimKerjaController::class, 'edit'])->name('tim_kerja.edit');
    });

    Route::middleware(['rbac:tim_kerja,2'])->group(function () {
        Route::post('/store', [TimKerjaController::class, 'store'])->name('tim_kerja.store');
    });

    Route::middleware(['rbac:tim_kerja,3'])->group(function () {
        Route::patch('/update', [TimKerjaController::class, 'update'])->name('tim_kerja.update');
    });

    Route::middleware(['rbac:tim_kerja,4'])->group(function () {
        Route::delete('/delete', [TimKerjaController::class, 'delete'])->name('tim_kerja.delete');
    });
});

Route::prefix('janji_maklumat')->group(function () {
    Route::middleware(['rbac:janji_maklumat,1'])->group(function () {
        Route::get('/', [JanjiMaklumatController::class, 'list'])->name('janji_maklumat');
        Route::get('/data', [JanjiMaklumatController::class, 'datatable'])->name('janji_maklumat.data');
        Route::get('/edit/{id}', [JanjiMaklumatController::class, 'edit'])->name('janji_maklumat.edit');
    });

    Route::middleware(['rbac:janji_maklumat,2'])->group(function () {
        Route::post('/store', [JanjiMaklumatController::class, 'store'])->name('janji_maklumat.store');
    });

    Route::middleware(['rbac:janji_maklumat,3'])->group(function () {
        Route::patch('/update', [JanjiMaklumatController::class, 'update'])->name('janji_maklumat.update');
    });

    Route::middleware(['rbac:janji_maklumat,4'])->group(function () {
        Route::delete('/delete', [JanjiMaklumatController::class, 'delete'])->name('janji_maklumat.delete');
    });
});

Route::prefix('profil_pejabat')->group(function () {
    Route::middleware(['rbac:profil_pejabat,1'])->group(function () {
        Route::get('/', [ProfilPejabatController::class, 'list'])->name('profil_pejabat');
        Route::get('/data', [ProfilPejabatController::class, 'datatable'])->name('profil_pejabat.data');
        Route::get('/edit/{id}', [ProfilPejabatController::class, 'edit'])->name('profil_pejabat.edit');
    });

    Route::middleware(['rbac:profil_pejabat,2'])->group(function () {
        Route::post('/store', [ProfilPejabatController::class, 'store'])->name('profil_pejabat.store');
    });

    Route::middleware(['rbac:profil_pejabat,3'])->group(function () {
        Route::patch('/update', [ProfilPejabatController::class, 'update'])->name('profil_pejabat.update');
    });

    Route::middleware(['rbac:profil_pejabat,4'])->group(function () {
        Route::delete('/delete', [ProfilPejabatController::class, 'delete'])->name('profil_pejabat.delete');
    });
});
