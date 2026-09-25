<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Panel\InformasiBerkalaController;
use App\Http\Controllers\Panel\PpidVisiMisiController;
use App\Http\Controllers\Panel\PpidTugasFungsiController;
use App\Http\Controllers\Panel\PpidLayananInformasiController;
use App\Http\Controllers\Panel\PpidInformasiDikecualikanController;
use App\Http\Controllers\Panel\PpidDaftarInformasiPublikController;


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

    Route::prefix('visi-misi')->group(function () {
        Route::middleware(['rbac:ppid_visi_misi,1'])->group(function () {
            Route::get('/', [PpidVisiMisiController::class, 'list'])->name('ppid-visi-misi');
            Route::get('/data', [PpidVisiMisiController::class, 'datatable'])->name('ppid-visi-misi.data');
            Route::get('/edit/{id}', [PpidVisiMisiController::class, 'edit'])->name('ppid-visi-misi.edit');
        });

        Route::middleware(['rbac:ppid_visi_misi,2'])->group(function () {
            Route::post('/store', [PpidVisiMisiController::class, 'store'])->name('ppid-visi-misi.store');
        });

        Route::middleware(['rbac:ppid_visi_misi,3'])->group(function () {
            Route::patch('/update', [PpidVisiMisiController::class, 'update'])->name('ppid-visi-misi.update');
        });

        Route::middleware(['rbac:ppid_visi_misi,4'])->group(function () {
            Route::delete('/delete', [PpidVisiMisiController::class, 'delete'])->name('ppid-visi-misi.delete');
        });
    });

    Route::prefix('tugas-fungsi')->group(function () {
        Route::middleware(['rbac:ppid_tugas_fungsi,1'])->group(function () {
            Route::get('/', [PpidTugasFungsiController::class, 'list'])->name('ppid-tugas-fungsi');
            Route::get('/data', [PpidTugasFungsiController::class, 'datatable'])->name('ppid-tugas-fungsi.data');
            Route::get('/edit/{id}', [PpidTugasFungsiController::class, 'edit'])->name('ppid-tugas-fungsi.edit');
        });

        Route::middleware(['rbac:ppid_tugas_fungsi,2'])->group(function () {
            Route::post('/store', [PpidTugasFungsiController::class, 'store'])->name('ppid-tugas-fungsi.store');
        });

        Route::middleware(['rbac:ppid_tugas_fungsi,3'])->group(function () {
            Route::patch('/update', [PpidTugasFungsiController::class, 'update'])->name('ppid-tugas-fungsi.update');
        });

        Route::middleware(['rbac:ppid_tugas_fungsi,4'])->group(function () {
            Route::delete('/delete', [PpidTugasFungsiController::class, 'delete'])->name('ppid-tugas-fungsi.delete');
        });
    });

    Route::prefix('layanan-informasi')->group(function () {
        Route::middleware(['rbac:layanan_informasi,1'])->group(function () {
            Route::get('/', [PpidLayananInformasiController::class, 'list'])->name('ppid-layanan-informasi');
            Route::get('/data', [PpidLayananInformasiController::class, 'datatable'])->name('ppid-layanan-informasi.data');
            Route::get('/edit/{id}', [PpidLayananInformasiController::class, 'edit'])->name('ppid-layanan-informasi.edit');
        });
        Route::middleware(['rbac:layanan_informasi,2'])->group(function () {
            Route::post('/store', [PpidLayananInformasiController::class, 'store'])->name('ppid-layanan-informasi.store');
        });
        Route::middleware(['rbac:layanan_informasi,3'])->group(function () {
            Route::patch('/update', [PpidLayananInformasiController::class, 'update'])->name('ppid-layanan-informasi.update');
        });
        Route::middleware(['rbac:layanan_informasi,4'])->group(function () {
            Route::delete('/delete', [PpidLayananInformasiController::class, 'delete'])->name('ppid-layanan-informasi.delete');
        });
    });

    Route::prefix('informasi-dikecualikan')->group(function () {
        Route::middleware(['rbac:informasi_dikecualikan,1'])->group(function () {
            Route::get('/', [PpidInformasiDikecualikanController::class, 'list'])->name('ppid-informasi-dikecualikan');
            Route::get('/data', [PpidInformasiDikecualikanController::class, 'datatable'])->name('ppid-informasi-dikecualikan.data');
            Route::get('/edit/{id}', [PpidInformasiDikecualikanController::class, 'edit'])->name('ppid-informasi-dikecualikan.edit');
        });
        Route::middleware(['rbac:informasi_dikecualikan,2'])->group(function () {
            Route::post('/store', [PpidInformasiDikecualikanController::class, 'store'])->name('ppid-informasi-dikecualikan.store');
        });
        Route::middleware(['rbac:informasi_dikecualikan,3'])->group(function () {
            Route::patch('/update', [PpidInformasiDikecualikanController::class, 'update'])->name('ppid-informasi-dikecualikan.update');
        });
        Route::middleware(['rbac:informasi_dikecualikan,4'])->group(function () {
            Route::delete('/delete', [PpidInformasiDikecualikanController::class, 'delete'])->name('ppid-informasi-dikecualikan.delete');
        });
    });

    Route::prefix('daftar-informasi-publik')->group(function () {
        Route::middleware(['rbac:daftar_informasi_publik,1'])->group(function () {
            Route::get('/', [PpidDaftarInformasiPublikController::class, 'list'])->name('ppid-daftar-informasi-publik');
            Route::get('/data', [PpidDaftarInformasiPublikController::class, 'datatable'])->name('ppid-daftar-informasi-publik.data');
            Route::get('/edit/{id}', [PpidDaftarInformasiPublikController::class, 'edit'])->name('ppid-daftar-informasi-publik.edit');
        });
        Route::middleware(['rbac:daftar_informasi_publik,2'])->group(function () {
            Route::post('/store', [PpidDaftarInformasiPublikController::class, 'store'])->name('ppid-daftar-informasi-publik.store');
        });
        Route::middleware(['rbac:daftar_informasi_publik,3'])->group(function () {
            Route::patch('/update', [PpidDaftarInformasiPublikController::class, 'update'])->name('ppid-daftar-informasi-publik.update');
        });
        Route::middleware(['rbac:daftar_informasi_publik,4'])->group(function () {
            Route::delete('/delete', [PpidDaftarInformasiPublikController::class, 'delete'])->name('ppid-daftar-informasi-publik.delete');
        });
    });

});


