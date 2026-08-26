<?php 


use App\Http\Controllers\Panel\NavbarMenuController;

Route::prefix('navbar-menu')->group(function () {
    Route::middleware(['rbac:navbar_menu,1'])->group(function () {
        Route::get('/', [NavbarMenuController::class, 'list'])->name('navbar-menu');
    });
    Route::middleware(['rbac:navbar_menu,3'])->group(function () {
        Route::post('/update', [NavbarMenuController::class, 'update'])->name('navbar-menu.update');
    });
});