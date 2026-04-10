<?php

use App\Http\Controllers\ImpersonateController;
use Illuminate\Support\Facades\Route;

Route::prefix('impersonate')->group(function () {
    Route::get('/start/{id}', [ImpersonateController::class, 'start'])->name('impersonate.start');
    Route::get('/stop', [ImpersonateController::class, 'stop'])->name('impersonate.stop');
});
