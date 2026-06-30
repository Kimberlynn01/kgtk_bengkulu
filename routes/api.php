<?php

use App\Http\Controllers\Api\LayananController;
use App\Http\Controllers\Api\ProfilController;
use App\Http\Controllers\Api\PublikasiController;
use App\Http\Controllers\Api\QnaController;
use App\Http\Controllers\Api\StrukturOrganisasiController;
use App\Http\Controllers\Api\DataSasaranController;
use App\Http\Controllers\Api\PermohonanInformasiController;
use App\Http\Controllers\Api\PermohonanKerjaSamaController;
use App\Http\Controllers\Api\PermohonanNarasumberController;
use App\Http\Controllers\Api\PermohonanSaranaPrasaranaController;
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

    // Struktur Organisasi
    Route::get('/struktur-organisasi', [StrukturOrganisasiController::class, 'index']);
    Route::get('/struktur-organisasi/{id}', [StrukturOrganisasiController::class, 'show']);

    // Data Sasaran
    Route::get('/data-sasaran', [DataSasaranController::class, 'index']);
    Route::get('/data-sasaran/{id}', [DataSasaranController::class, 'show']);

    // Permohonan
    Route::get('/permohonan-informasi', [PermohonanInformasiController::class, 'index']);
    Route::get('/permohonan-kerja-sama', [PermohonanKerjaSamaController::class, 'index']);
    Route::get('/permohonan-narasumber', [PermohonanNarasumberController::class, 'index']);
    Route::get('/permohonan-sarana-prasarana', [PermohonanSaranaPrasaranaController::class, 'index']);

    // QnA
    Route::post('/ask', [QnaController::class, 'ask']);

    // Test
    Route::get('/test', function () {
        return response()->json(['message' => 'API Berhasil diakses']);
    });


    Route::fallback(function () {
        return response()->json([
            'status' => false,
            'message' => 'Endpoint tidak ditemukan.',
            'data' => null,
        ], 404);
    });
});