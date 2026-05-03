<?php

use App\Http\Controllers\Panel\KemitraanController;
use Illuminate\Support\Facades\Route;




Route::prefix('partnership')->group(function () {
    Route::get('/', [KemitraanController::class, 'show'])->name('front.partnership');
});
