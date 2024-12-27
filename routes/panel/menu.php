<?php

use App\Http\Controllers\Panel\MenusController;

Route::prefix('manajemen-menu')->group(function () {
    Route::middleware(['rbac:manajemen_menu'])->group(function () {
        Route::get('/', [MenusController::class, 'index'])->name('manajemen-menu');
        Route::get('/data', [MenusController::class, 'data'])->name('manajemen-menu.data');
        Route::get('/get/main-menu', [MenusController::class, 'getMainMenu'])->name('manajemen-menu.get.main-menu');
    });

    Route::middleware(['rbac:manajemen_menu,2'])->group(function () {
        Route::post('/store', [MenusController::class, 'store'])->name('manajemen-menu.store');
    });

    Route::middleware(['rbac:manajemen_menu,3'])->group(function () {
        Route::patch('/update', [MenusController::class, 'update'])->name('manajemen-menu.update');
    });

    Route::delete('/delete', [MenusController::class, 'delete'])->name('manajemen-menu.delete')->middleware(['rbac:manajemen_menu,4']);
});
