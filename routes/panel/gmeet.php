<?php
use App\Http\Controllers\Panel\ConsultationSessionController;

Route::prefix('consultation-session')->group(function () {
    Route::middleware(['rbac:qna,1'])->group(function () {
        Route::get('/', [ConsultationSessionController::class, 'list'])->name('consultation-session');
        Route::get('/data', [ConsultationSessionController::class, 'datatable'])->name('consultation-session.data');
        Route::get('/check', [ConsultationSessionController::class, 'checkAvailability'])->name('consultation-session.check');
    });
    Route::middleware(['rbac:qna,2'])->group(function () {
        Route::post('/store', [ConsultationSessionController::class, 'store'])->name('consultation-session.store');
    });
    Route::middleware(['rbac:qna,3'])->group(function () {
        Route::post('/update', [ConsultationSessionController::class, 'update'])->name('consultation-session.update');
    });
    Route::middleware(['rbac:qna,4'])->group(function () {
        Route::delete('/delete', [ConsultationSessionController::class, 'delete'])->name('consultation-session.delete');
    });
});