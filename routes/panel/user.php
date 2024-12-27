<?php

use App\Http\Controllers\Panel\UserController;

Route::prefix('users')->group(function () {

    Route::middleware(['rbac:pengguna'])->group(function () {
        Route::get('/', [UserController::class, 'list'])->name('users');
        Route::get('/data', [UserController::class, 'datatable'])->name('users.data');
    });

    Route::middleware(['rbac:pengguna,2'])->group(function () {
        Route::post('/store', [UserController::class, 'store'])->name('users.store');
    });

    Route::middleware(['rbac:pengguna,3'])->group(function () {
        Route::patch('/update', [UserController::class, 'update'])->name('users.update');
        Route::patch('/switch', [UserController::class, 'switchStatus'])->name('users.switch');
        Route::patch('/update/roles', [UserController::class, 'updateRole'])->name('users.update.roles');
        Route::patch('/reset-password', [UserController::class, 'resetPassword'])->name('users.reset-password');
        Route::patch('/change-password', [UserController::class, 'changePassword'])->name('users.change-password');
    });

    Route::delete('/delete', [UserController::class, 'delete'])->name('users.delete')->middleware('rbac:pengguna,4');
});
