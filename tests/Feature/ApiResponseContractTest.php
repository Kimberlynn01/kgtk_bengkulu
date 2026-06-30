<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\getJson;

uses(RefreshDatabase::class);

// ==========================================
// 1. STANDAR STRUKTUR RESPONS YANG DIHARAPKAN (KONTRAK KETAT)
// ==========================================

// Struktur pagination bawaan Laravel (Untuk ->paginate(10))
$laravelPaginationStructure = [
    'current_page',
    'data',
    'first_page_url',
    'from',
    'last_page',
    'last_page_url',
    'links' => [
        '*' => ['url', 'label', 'active']
    ],
    'next_page_url',
    'path',
    'per_page',
    'prev_page_url',
    'to',
    'total',
];

// Struktur fallback dari Route::fallback kamu
$fallbackStructure = [
    'status',
    'message',
    'data'
];

// ==========================================
// 2. TESTING METHOD "GET"
// ==========================================

// --- Kelompok A: Endpoint yang seharusnya mengembalikan Array/Collection ---
$collectionGetEndpoints = [
    '/api/v1/visi-misi',
    '/api/v1/tugas-fungsi',
    '/api/v1/tim-kerja',
    '/api/v1/janji-maklumat',
    '/api/v1/profil-pejabat',
    '/api/v1/informasi-programs',
    '/api/v1/kemitraans',
];

foreach ($collectionGetEndpoints as $endpoint) {
    test("GET {$endpoint} - Response format harus berupa Array/Collection JSON", function () use ($endpoint) {
        $response = getJson($endpoint);

        $response->assertStatus(200);
        
        // Memaksa root respons berupa array
        $response->assertJsonStructure(['*' => []]);
    });
}

// --- Kelompok B: Endpoint yang seharusnya mengembalikan Objek Pagination Laravel ---
$paginatedGetEndpoints = [
    '/api/v1/artikels',
    '/api/v1/beritas',
    '/api/v1/skms',
    '/api/v1/hasil-surveys',
    '/api/v1/struktur-organisasi',
    '/api/v1/data-sasaran',
];

foreach ($paginatedGetEndpoints as $endpoint) {
    test("GET {$endpoint} - Response format harus berupa Paginated Object Laravel", function () use ($endpoint, $laravelPaginationStructure) {
        $response = getJson($endpoint);

        $response->assertStatus(200);
        $response->assertJsonStructure($laravelPaginationStructure);
    });
}

// --- Kelompok C: Endpoint Record Tunggal / Detail Terbaru ---
// Di sini kita pasang ekspektasi KETAT bahwa respons harus berupa Objek Data Tunggal (bukan array []).
// Kita biarkan test ini FAIL jika controller-mu malah mengembalikan array kosong saat data kosong.
$singleRecordGetEndpoints = [
    '/api/v1/permohonan-informasi',
    '/api/v1/permohonan-kerja-sama',
    '/api/v1/permohonan-narasumber',
    '/api/v1/permohonan-sarana-prasarana',
];

foreach ($singleRecordGetEndpoints as $endpoint) {
    test("GET {$endpoint} - Response format harus berupa Single Object atau Null (Bukan Array)", function () use ($endpoint) {
        $response = getJson($endpoint);

        $response->assertStatus(200);
        
        // Kita paksa cek bahwa responsnya adalah Null ketika DB kosong.
        // Jika responsnya malah array kosong [], test akan otomatis MERAH (FAIL).
        expect($response->json())->toBeNull();
    });
}

// --- Kelompok D: Endpoint Detail Menggunakan Parameter {id} (Not Found) ---
$detailGetEndpoints = [
    '/api/v1/artikels/99999',
    '/api/v1/beritas/99999',
    '/api/v1/struktur-organisasi/99999',
    '/api/v1/data-sasaran/99999',
];

foreach ($detailGetEndpoints as $endpoint) {
    test("GET {$endpoint} - Data tidak ditemukan wajib melempar status 404", function () use ($endpoint) {
        $response = getJson($endpoint);

        $response->assertStatus(404);
    });
}

// ==========================================
// 3. UTILITY & FALLBACK ROUTE
// ==========================================

test('GET /api/v1/test - Health Check validasi', function () {
    $response = getJson('/api/v1/test');

    $response->assertStatus(200);
    $response->assertJsonStructure(['message']);
});

test('GET /api/v1/route-ngawur - Fallback 404', function () use ($fallbackStructure) {
    $response = getJson('/api/v1/route-ngawur');

    $response->assertStatus(404);
    $response->assertJsonStructure($fallbackStructure);
});