<?php

use App\Http\Controllers\Panel\PeningkatanGuruController;
use App\Http\Controllers\Panel\PeningkatanKompetensiKepalaSekolahController;
use App\Http\Controllers\Panel\PeningkatanKompetensiPengawasSekolahController;
use App\Http\Controllers\Panel\PeningkatanKompetensiTenagaPendidikanController;
use Illuminate\Support\Facades\Route;

Route::prefix('peningkatan-guru')->group(function () {
    Route::middleware(['rbac:peningkatan_guru,1'])->group(function () {
        Route::get('/', [PeningkatanGuruController::class, 'list'])->name('peningkatan_guru');
        Route::get('/data', [PeningkatanGuruController::class, 'data'])->name('peningkatan_guru.data');
    });
    Route::middleware(['rbac:peningkatan_guru,2'])->group(function () {
        Route::post('/save', [PeningkatanGuruController::class, 'save'])->name('peningkatan_guru.save');
    });
    Route::middleware(['rbac:peningkatan_guru,4'])->group(function () {
        Route::delete('/delete', [PeningkatanGuruController::class, 'delete'])->name('peningkatan_guru.delete');
    });
});

Route::prefix('peningkatan-kompetensi-kepala-sekolah')->group(function () {
    Route::middleware(['rbac:peningkatan_kompetensi_kepala_sekolah,1'])->group(function () {
        Route::get('/', [PeningkatanKompetensiKepalaSekolahController::class, 'list'])->name('peningkatan_kompetensi_kepala_sekolah');
        Route::get('/data', [PeningkatanKompetensiKepalaSekolahController::class, 'data'])->name('peningkatan_kompetensi_kepala_sekolah.data');
    });
    Route::middleware(['rbac:peningkatan_kompetensi_kepala_sekolah,2'])->group(function () {
        Route::post('/save', [PeningkatanKompetensiKepalaSekolahController::class, 'save'])->name('peningkatan_kompetensi_kepala_sekolah.save');
    });
    Route::middleware(['rbac:peningkatan_kompetensi_kepala_sekolah,4'])->group(function () {
        Route::delete('/delete', [PeningkatanKompetensiKepalaSekolahController::class, 'delete'])->name('peningkatan_kompetensi_kepala_sekolah.delete');
    });
});

Route::prefix('peningkatan-kompetensi-pengawas-sekolah')->group(function () {
    Route::middleware(['rbac:peningkatan_kompetensi_pengawas_sekolah,1'])->group(function () {
        Route::get('/', [PeningkatanKompetensiPengawasSekolahController::class, 'list'])->name('peningkatan_kompetensi_pengawas_sekolah');
        Route::get('/data', [PeningkatanKompetensiPengawasSekolahController::class, 'data'])->name('peningkatan_kompetensi_pengawas_sekolah.data');
    });
    Route::middleware(['rbac:peningkatan_kompetensi_pengawas_sekolah,2'])->group(function () {
        Route::post('/save', [PeningkatanKompetensiPengawasSekolahController::class, 'save'])->name('peningkatan_kompetensi_pengawas_sekolah.save');
    });
    Route::middleware(['rbac:peningkatan_kompetensi_pengawas_sekolah,4'])->group(function () {
        Route::delete('/delete', [PeningkatanKompetensiPengawasSekolahController::class, 'delete'])->name('peningkatan_kompetensi_pengawas_sekolah.delete');
    });
});

Route::prefix('peningkatan-kompetensi-tenaga-pendidikan')->group(function () {
    Route::middleware(['rbac:peningkatan_kompetensi_tenaga_pendidikan,1'])->group(function () {
        Route::get('/', [PeningkatanKompetensiTenagaPendidikanController::class, 'list'])->name('peningkatan_kompetensi_tenaga_pendidikan');
        Route::get('/data', [PeningkatanKompetensiTenagaPendidikanController::class, 'data'])->name('peningkatan_kompetensi_tenaga_pendidikan.data');
    });
    Route::middleware(['rbac:peningkatan_kompetensi_tenaga_pendidikan,2'])->group(function () {
        Route::post('/save', [PeningkatanKompetensiTenagaPendidikanController::class, 'save'])->name('peningkatan_kompetensi_tenaga_pendidikan.save');
    });
    Route::middleware(['rbac:peningkatan_kompetensi_tenaga_pendidikan,4'])->group(function () {
        Route::delete('/delete', [PeningkatanKompetensiTenagaPendidikanController::class, 'delete'])->name('peningkatan_kompetensi_tenaga_pendidikan.delete');
    });
});
