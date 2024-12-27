<?php

use App\Http\Controllers\Panel\OtoritasController;

Route::prefix('otoritas')->group(function () {
    Route::middleware(['rbac:otoritas'])->group(function () {
        Route::get('/', [OtoritasController::class, 'index'])->name('otoritas');
        Route::get('/data', [OtoritasController::class, 'data'])->name('otoritas.data');
    });

    Route::middleware(['rbac:otoritas,2'])->group(function () {
        Route::post('/store', [OtoritasController::class, 'store'])->name('otoritas.store');
    });

    Route::middleware(['rbac:otoritas,3'])->group(function () {
        Route::patch('/update', [OtoritasController::class, 'update'])->name('otoritas.update');

        Route::get('/permission/{slug}', [OtoritasController::class, 'formPermission'])->name('otoritas.open.permission');
        Route::patch('/permission', [OtoritasController::class, 'submitPermission'])->name('otoritas.submit.permission');
    });

    Route::delete('/delete', [OtoritasController::class, 'delete'])->name('otoritas.delete')->middleware('rbac:otoritas,4');
});
