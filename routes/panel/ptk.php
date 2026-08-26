<?php 

use App\Http\Controllers\Panel\PtkController;
use App\Http\Controllers\Panel\PtkFieldController;
use App\Http\Controllers\Panel\PtkRecapController;

Route::prefix('ptk')->group(function () {
    Route::middleware(['rbac:ptk,1'])->group(function () {
        Route::get('/', [PtkController::class, 'list'])->name('ptk');
        Route::get('/data', [PtkController::class, 'datatable'])->name('ptk.data');
        Route::get('/edit/{id}', [PtkController::class, 'edit'])->name('ptk.edit');
        Route::get('/recap', [PtkRecapController::class, 'index'])->name('ptk.recap');
        Route::post('/recap/generate', [PtkRecapController::class, 'generate'])->name('ptk.recap.generate');
    });

    Route::middleware(['rbac:ptk,2'])->group(function () {
        Route::post('/store', [PtkController::class, 'store'])->name('ptk.store');
        Route::post('/import', [PtkController::class, 'import'])->name('ptk.import');
    });

    Route::middleware(['rbac:ptk,3'])->group(function () {
        Route::post('/update/{id}', [PtkController::class, 'update'])->name('ptk.update');
    });

    Route::middleware(['rbac:ptk,4'])->group(function () {
        Route::delete('/delete', [PtkController::class, 'delete'])->name('ptk.delete');
    });

    Route::middleware(['rbac:ptk,5'])->group(function () {
        Route::get('/import-template', [PtkController::class, 'importTemplate'])->name('ptk.import-template');
        Route::get('/recap/export', [PtkRecapController::class, 'export'])->name('ptk.recap.export');
    });
});

Route::prefix('ptk-field')->group(function () {
    Route::middleware(['rbac:ptk,1'])->group(function () {
        Route::get('/', [PtkFieldController::class, 'list'])->name('ptk-field');
        Route::get('/data', [PtkFieldController::class, 'datatable'])->name('ptk-field.data');
    });
    Route::middleware(['rbac:ptk,2'])->group(function () {
        Route::post('/store', [PtkFieldController::class, 'store'])->name('ptk-field.store');
    });
    Route::middleware(['rbac:ptk,3'])->group(function () {
        Route::post('/update', [PtkFieldController::class, 'update'])->name('ptk-field.update');
    });
    Route::middleware(['rbac:ptk,4'])->group(function () {
        Route::delete('/delete', [PtkFieldController::class, 'delete'])->name('ptk-field.delete');
    });
});