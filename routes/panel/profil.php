<?php

use App\Http\Controllers\Panel\ProfilController;

Route::prefix('profil')->group(function () {

    Route::middleware(['rbac:profil,1'])->group(function () {
        Route::get('/', [ProfilController::class, 'index'])->name('profil');
    });

    Route::middleware(['rbac:profil,2'])->group(function () {
        Route::post('/store', [ProfilController::class, 'store'])->name('profil.store');
    });

    Route::middleware(['rbac:profil,2'])->group(function () {
        Route::post('/change-password', [ProfilController::class, 'change_password'])->name('profil.change-password');
    });
});
