<?php

use App\Http\Controllers\Panel\ArtikelController;
use App\Http\Controllers\Panel\BeritaController;
use App\Http\Controllers\Panel\SkmController;
use App\Http\Controllers\Panel\HasilSurveyController;
use Illuminate\Support\Facades\Route;

Route::prefix('artikel')->group(function () {
    Route::middleware(['rbac:artikel,1'])->group(function () {
        Route::get('/', [ArtikelController::class, 'list'])->name('artikel');
        Route::get('/data', [ArtikelController::class, 'datatable'])->name('artikel.data');
        Route::get('/edit/{id}', [ArtikelController::class, 'edit'])->name('artikel.edit');
    });

    Route::middleware(['rbac:artikel,2'])->group(function () {
        Route::post('/store', [ArtikelController::class, 'store'])->name('artikel.store');
    });

    Route::middleware(['rbac:artikel,3'])->group(function () {
        Route::patch('/update', [ArtikelController::class, 'update'])->name('artikel.update');
    });

    Route::middleware(['rbac:artikel,4'])->group(function () {
        Route::delete('/delete', [ArtikelController::class, 'delete'])->name('artikel.delete');
    });
});

Route::prefix('berita')->group(function () {
    Route::middleware(['rbac:berita,1'])->group(function () {
        Route::get('/', [BeritaController::class, 'list'])->name('berita');
        Route::get('/data', [BeritaController::class, 'datatable'])->name('berita.data');
        Route::get('/edit/{id}', [BeritaController::class, 'edit'])->name('berita.edit');
    });

    Route::middleware(['rbac:berita,2'])->group(function () {
        Route::post('/store', [BeritaController::class, 'store'])->name('berita.store');
    });

    Route::middleware(['rbac:berita,3'])->group(function () {
        Route::patch('/update', [BeritaController::class, 'update'])->name('berita.update');
    });

    Route::middleware(['rbac:berita,4'])->group(function () {
        Route::delete('/delete', [BeritaController::class, 'delete'])->name('berita.delete');
    });
});

Route::prefix('skm')->group(function () {
    Route::middleware(['rbac:skm,1'])->group(function () {
        Route::get('/', [SkmController::class, 'list'])->name('skm');
        Route::get('/data', [SkmController::class, 'datatable'])->name('skm.data');
        Route::get('/edit/{id}', [SkmController::class, 'edit'])->name('skm.edit');
    });

    Route::middleware(['rbac:skm,2'])->group(function () {
        Route::post('/store', [SkmController::class, 'store'])->name('skm.store');
    });

    Route::middleware(['rbac:skm,3'])->group(function () {
        Route::patch('/update', [SkmController::class, 'update'])->name('skm.update');
    });

    Route::middleware(['rbac:skm,4'])->group(function () {
        Route::delete('/delete', [SkmController::class, 'delete'])->name('skm.delete');
    });
});

Route::prefix('hasil_survey')->group(function () {
    Route::middleware(['rbac:hasil_survey,1'])->group(function () {
        Route::get('/', [HasilSurveyController::class, 'list'])->name('hasil_survey');
        Route::get('/data', [HasilSurveyController::class, 'datatable'])->name('hasil_survey.data');
        Route::get('/edit/{id}', [HasilSurveyController::class, 'edit'])->name('hasil_survey.edit');
    });

    Route::middleware(['rbac:hasil_survey,2'])->group(function () {
        Route::post('/store', [HasilSurveyController::class, 'store'])->name('hasil_survey.store');
    });

    Route::middleware(['rbac:hasil_survey,3'])->group(function () {
        Route::patch('/update', [HasilSurveyController::class, 'update'])->name('hasil_survey.update');
    });

    Route::middleware(['rbac:hasil_survey,4'])->group(function () {
        Route::delete('/delete', [HasilSurveyController::class, 'delete'])->name('hasil_survey.delete');
    });
});
