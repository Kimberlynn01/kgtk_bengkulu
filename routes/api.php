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
use App\Http\Controllers\Api\ProgramPeningkatanController;
use App\Http\Controllers\Api\NavbarMenuController;
use App\Http\Controllers\Api\PtkController;
use App\Http\Controllers\Api\ConsultationSessionController;
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
    Route::get('/sejarah', [ProfilController::class, 'getSejarahs']);
    Route::get('/sejarah/{id}', [ProfilController::class, 'getSejarah']);
    Route::get('/perilaku-core-value', [ProfilController::class, 'getPerilakuCoreValues']);
    Route::get('/perilaku-core-value/{id}', [ProfilController::class, 'getPerilakuCoreValue']);
    Route::get('/rencana-strategis', [ProfilController::class, 'getRencanaStrategis']);
    Route::get('/rencana-strategis/{id}', [ProfilController::class, 'getRencanaStrategisDetail']);
    Route::get('/perjanjian-kerja', [ProfilController::class, 'getPerjanjianKerja']);
    Route::get('/perjanjian-kerja/{id}', [ProfilController::class, 'getPerjanjianKerjaDetail']);
    Route::get('/laporan-kerja', [ProfilController::class, 'getLaporanKerja']);
    Route::get('/laporan-kerja/{id}', [ProfilController::class, 'getLaporanKerjaDetail']);

    // Layanan
    Route::get('/informasi-programs', [LayananController::class, 'getInformasiPrograms']);
    Route::get('/program-peningkatan', [ProgramPeningkatanController::class, 'getAll']);
    Route::get('/peningkatan-guru', [ProgramPeningkatanController::class, 'getPeningkatanGuru']);
    Route::get('/peningkatan-kompetensi-kepala-sekolah', [ProgramPeningkatanController::class, 'getPeningkatanKompetensiKepalaSekolah']);
    Route::get('/peningkatan-kompetensi-pengawas-sekolah', [ProgramPeningkatanController::class, 'getPeningkatanKompetensiPengawasSekolah']);
    Route::get('/peningkatan-kompetensi-tenaga-pendidikan', [ProgramPeningkatanController::class, 'getPeningkatanKompetensiTenagaPendidikan']);
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
    Route::get('/qna/categories', [QnaController::class, 'categories']);
    Route::post('/ask', [QnaController::class, 'ask']);

    // Test
    Route::get('/test', function () {
        return response()->json(['message' => 'API Berhasil diakses']);
    });

    // Navbar Fetch
    Route::get('/navbar-menu', [NavbarMenuController::class, 'index']);

    // Fetch PTK
    Route::prefix('ptk')->group(function () {
        Route::get('/fields', [PtkController::class, 'fields']);
        Route::get('/recap', [PtkController::class, 'recap']);
    });

    Route::get('/consultation-session', [ConsultationSessionController::class, 'show']);


    Route::fallback(function () {
        return response()->json([
            'status' => false,
            'message' => 'Endpoint tidak ditemukan.',
            'data' => null,
        ], 404);
    });
});