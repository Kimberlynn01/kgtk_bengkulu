<?php

use App\Http\Controllers\Panel\ArtikelController;
use App\Http\Controllers\Panel\BeritaController;
use App\Http\Controllers\Panel\HasilSurveyController;
use App\Http\Controllers\Panel\SkmController;
use Illuminate\Support\Facades\Route;




Route::prefix('news')->group(function () {
    Route::get('/', [BeritaController::class, 'show'])->name('front.berita');
    Route::get('/{slug}', [BeritaController::class, 'showBySlug'])->name('front.berita.detail');
});


Route::prefix('article')->group(function () {
    Route::get('/', [ArtikelController::class, 'show'])->name('front.article');
    Route::get('/{slug}', [ArtikelController::class, 'showBySlug'])->name('front.article.detail');
});


Route::prefix('survey-kepuasan-masyarakat')->group(function () {
    Route::get('/', [SkmController::class, 'show'])->name('front.skm');
});

Route::prefix('hasil-survey')->group(function () {
    Route::get('/', [HasilSurveyController::class, 'show'])->name('front.hasil_survey');
});
