<?php

use App\Http\Controllers\Api\LayananController;
use App\Http\Controllers\Api\ProfilController;
use App\Http\Controllers\Api\PublikasiController;
use App\Http\Controllers\Api\QnaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    // Publikasi
    Route::get('/artikels', [PublikasiController::class, 'getArtikels']);
    Route::get('/artikels/{id}', [PublikasiController::class, 'getArtikel']);
    Route::get('/beritas', [PublikasiController::class, 'getBeritas']);
    Route::get('/beritas/{id}', [PublikasiController::class, 'getBerita']);
    Route::get('/skms', [PublikasiController::class, 'getSkms']);
    Route::get('/hasil-surveys', [PublikasiController::class, 'getHasilSurveys']);

    // Profil
    Route::get('/visi-misi', [ProfilController::class, 'getVisiMisi']);
    Route::get('/tugas-fungsi', [ProfilController::class, 'getTugasFungsi']);
    Route::get('/tim-kerja', [ProfilController::class, 'getTimKerja']);
    Route::get('/janji-maklumat', [ProfilController::class, 'getJanjiMaklumat']);
    Route::get('/profil-pejabat', [ProfilController::class, 'getProfilPejabat']);

    // Layanan
    Route::get('/informasi-programs', [LayananController::class, 'getInformasiPrograms']);
    Route::get('/kemitraans', [LayananController::class, 'getKemitraans']);

    Route::post('/ask', [QnaController::class, 'ask']);

    Route::get('/test', function() {
    return response()->json(['message' => 'API Berhasil diakses']);
});
});
