<?php

use App\Http\Controllers\Panel\SejarahController;
use App\Http\Controllers\Panel\PerilakuCoreValueController;
use App\Http\Controllers\Panel\RencanaStrategisController;
use App\Http\Controllers\Panel\PerjanjianKerjaController;
use App\Http\Controllers\Panel\LaporanKerjaController;
use Illuminate\Support\Facades\Route;

Route::prefix('sejarah')->group(function () {
    Route::middleware(['rbac:sejarah,1'])->group(function () {
        Route::get('/', [SejarahController::class, 'list'])->name('sejarah');
        Route::get('/data', [SejarahController::class, 'datatable'])->name('sejarah.data');
        Route::get('/edit/{id}', [SejarahController::class, 'edit'])->name('sejarah.edit');
    });

    Route::middleware(['rbac:sejarah,2'])->group(function () {
        Route::post('/store', [SejarahController::class, 'store'])->name('sejarah.store');
    });

    Route::middleware(['rbac:sejarah,3'])->group(function () {
        Route::patch('/update', [SejarahController::class, 'update'])->name('sejarah.update');
    });

    Route::middleware(['rbac:sejarah,4'])->group(function () {
        Route::delete('/delete', [SejarahController::class, 'delete'])->name('sejarah.delete');
    });
});

Route::prefix('perilaku-core-value')->group(function () {
    Route::middleware(['rbac:perilaku_core_value,1'])->group(function () {
        Route::get('/', [PerilakuCoreValueController::class, 'list'])->name('perilaku_core_value');
        Route::get('/data', [PerilakuCoreValueController::class, 'datatable'])->name('perilaku_core_value.data');
        Route::get('/edit/{id}', [PerilakuCoreValueController::class, 'edit'])->name('perilaku_core_value.edit');
    });

    Route::middleware(['rbac:perilaku_core_value,2'])->group(function () {
        Route::post('/store', [PerilakuCoreValueController::class, 'store'])->name('perilaku_core_value.store');
    });

    Route::middleware(['rbac:perilaku_core_value,3'])->group(function () {
        Route::patch('/update', [PerilakuCoreValueController::class, 'update'])->name('perilaku_core_value.update');
    });

    Route::middleware(['rbac:perilaku_core_value,4'])->group(function () {
        Route::delete('/delete', [PerilakuCoreValueController::class, 'delete'])->name('perilaku_core_value.delete');
    });
});

Route::prefix('rencana-strategis')->group(function () {
    Route::middleware(['rbac:rencana_strategis,1'])->group(function () {
        Route::get('/', [RencanaStrategisController::class, 'list'])->name('rencana_strategis');
        Route::get('/data', [RencanaStrategisController::class, 'datatable'])->name('rencana_strategis.data');
        Route::get('/edit/{id}', [RencanaStrategisController::class, 'edit'])->name('rencana_strategis.edit');
    });

    Route::middleware(['rbac:rencana_strategis,2'])->group(function () {
        Route::post('/store', [RencanaStrategisController::class, 'store'])->name('rencana_strategis.store');
    });

    Route::middleware(['rbac:rencana_strategis,3'])->group(function () {
        Route::patch('/update', [RencanaStrategisController::class, 'update'])->name('rencana_strategis.update');
    });

    Route::middleware(['rbac:rencana_strategis,4'])->group(function () {
        Route::delete('/delete', [RencanaStrategisController::class, 'delete'])->name('rencana_strategis.delete');
    });
});

Route::prefix('perjanjian-kerja')->group(function () {
    Route::middleware(['rbac:perjanjian_kerja,1'])->group(function () {
        Route::get('/', [PerjanjianKerjaController::class, 'list'])->name('perjanjian_kerja');
        Route::get('/data', [PerjanjianKerjaController::class, 'datatable'])->name('perjanjian_kerja.data');
        Route::get('/edit/{id}', [PerjanjianKerjaController::class, 'edit'])->name('perjanjian_kerja.edit');
    });

    Route::middleware(['rbac:perjanjian_kerja,2'])->group(function () {
        Route::post('/store', [PerjanjianKerjaController::class, 'store'])->name('perjanjian_kerja.store');
    });

    Route::middleware(['rbac:perjanjian_kerja,3'])->group(function () {
        Route::patch('/update', [PerjanjianKerjaController::class, 'update'])->name('perjanjian_kerja.update');
    });

    Route::middleware(['rbac:perjanjian_kerja,4'])->group(function () {
        Route::delete('/delete', [PerjanjianKerjaController::class, 'delete'])->name('perjanjian_kerja.delete');
    });
});

Route::prefix('laporan-kerja')->group(function () {
    Route::middleware(['rbac:laporan_kerja,1'])->group(function () {
        Route::get('/', [LaporanKerjaController::class, 'list'])->name('laporan_kerja');
        Route::get('/data', [LaporanKerjaController::class, 'datatable'])->name('laporan_kerja.data');
        Route::get('/edit/{id}', [LaporanKerjaController::class, 'edit'])->name('laporan_kerja.edit');
    });

    Route::middleware(['rbac:laporan_kerja,2'])->group(function () {
        Route::post('/store', [LaporanKerjaController::class, 'store'])->name('laporan_kerja.store');
    });

    Route::middleware(['rbac:laporan_kerja,3'])->group(function () {
        Route::patch('/update', [LaporanKerjaController::class, 'update'])->name('laporan_kerja.update');
    });

    Route::middleware(['rbac:laporan_kerja,4'])->group(function () {
        Route::delete('/delete', [LaporanKerjaController::class, 'delete'])->name('laporan_kerja.delete');
    });
});
