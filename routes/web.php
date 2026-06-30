<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UtilityController;
use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\LandingController::class, 'index'])->name('landing');

Route::get('/dashboard', function () {
    return view('dashboard', [
        'title' => 'Beranda'
    ]);
})->middleware(['auth', 'verified', 'rbac:beranda,1'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('menus', [UtilityController::class, 'loadMenu'])->name('load-menu');

    require __DIR__ . '/panel/user.php';
    require __DIR__ . '/panel/menu.php';
    require __DIR__ . '/panel/otoritas.php';
    require __DIR__ . '/panel/profil.php';
    require __DIR__ . '/panel/publikasi.php';
    require __DIR__ . '/panel/profil_kgtk.php';
    require __DIR__ . '/panel/layanan.php';
    require __DIR__ . '/panel/impersonate.php';
    require __DIR__ . '/panel/data-sasaran.php';
    require __DIR__ . '/panel/permohonan_narasumber.php';
    require __DIR__ . '/panel/permohonan_sarana_prasarana.php';
    require __DIR__ . '/panel/permohonan-informasi.php';
    require __DIR__ . '/panel/permohonan-kerja-sama.php';
    require __DIR__ . '/panel/struktur-organisasi.php';
});



require __DIR__ . '/auth.php';
require __DIR__ . '/panel/qna.php';

// FRONT-END
require __DIR__ . '/panel/front-publikasi.php';
require __DIR__ . '/panel/front-layanan.php';
require __DIR__ . '/panel/front-profil_kgtk.php';

