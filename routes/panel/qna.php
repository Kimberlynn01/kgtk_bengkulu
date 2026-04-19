<?php

use App\Http\Controllers\Panel\QnaController;
use Illuminate\Support\Facades\Route;

Route::post('ask', [QnaController::class, 'store'])->name('qna.store');

Route::prefix('qna')->group(function () {
    Route::middleware(['rbac:qna,1'])->group(function () {
        Route::get('/', [QnaController::class, 'list'])->name('qna');
        Route::get('/data', [QnaController::class, 'datatable'])->name('qna.data');
        Route::get('/edit/{id}', [QnaController::class, 'edit'])->name('qna.edit');
    });

    Route::middleware(['rbac:qna,2'])->group(function () {
        Route::post('/store', [QnaController::class, 'store'])->name('qna.store');
    });

    Route::middleware(['rbac:qna,3'])->group(function () {
        Route::patch('/update', [QnaController::class, 'update'])->name('qna.update');
    });

    Route::middleware(['rbac:qna,4'])->group(function () {
        Route::delete('/delete', [QnaController::class, 'delete'])->name('qna.delete');
    });
});
