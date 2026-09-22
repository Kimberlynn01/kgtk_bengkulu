<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Panel\InformasiBerkalaController;


Route::prefix('ppid/')->group(function () {   
    Route::prefix('informasi-berkala')->group(function () {
        Route::middleware(['rbac:informasi_berkala,1'])->group(function () {
            Route::get('/', [InformasiBerkalaController::class, 'list'])->name('informasi-berkala');
            Route::get('/data', [InformasiBerkalaController::class, 'datatable'])->name('informasi-berkala.data');
            Route::get('/edit/{id}', [InformasiBerkalaController::class, 'edit'])->name('informasi-berkala.edit');
        });

        Route::middleware(['rbac:informasi_berkala,2'])->group(function () {
            Route::post('/store', [InformasiBerkalaController::class, 'store'])->name('informasi-berkala.store');
        });

        Route::middleware(['rbac:informasi_berkala,3'])->group(function () {
            Route::patch('/update', [InformasiBerkalaController::class, 'update'])->name('informasi-berkala.update');
        });

        Route::middleware(['rbac:informasi_berkala,4'])->group(function () {
            Route::delete('/delete', [InformasiBerkalaController::class, 'delete'])->name('informasi-berkala.delete');
        });
    });
});


