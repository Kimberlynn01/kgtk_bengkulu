<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PeningkatanGuru;
use App\Models\PeningkatanKompetensiKepalaSekolah;
use App\Models\PeningkatanKompetensiPengawasSekolah;
use App\Models\PeningkatanKompetensiTenagaPendidikan;

class ProgramPeningkatanController extends Controller
{
    // Masing-masing resource cuma punya maksimal 1 data, jadi cukup `first()`
    // dan tidak perlu endpoint by-id seperti resource lain.

    public function getPeningkatanGuru()
    {
        $data = PeningkatanGuru::first();
        return response()->json($data);
    }

    public function getPeningkatanKompetensiKepalaSekolah()
    {
        $data = PeningkatanKompetensiKepalaSekolah::first();
        return response()->json($data);
    }

    public function getPeningkatanKompetensiPengawasSekolah()
    {
        $data = PeningkatanKompetensiPengawasSekolah::first();
        return response()->json($data);
    }

    public function getPeningkatanKompetensiTenagaPendidikan()
    {
        $data = PeningkatanKompetensiTenagaPendidikan::first();
        return response()->json($data);
    }

    // Kalau mau ambil sekaligus 4-4-nya dalam 1 request (misal buat halaman "Program" di frontend)
    public function getAll()
    {
        return response()->json([
            'peningkatan_guru' => PeningkatanGuru::first(),
            'peningkatan_kompetensi_kepala_sekolah' => PeningkatanKompetensiKepalaSekolah::first(),
            'peningkatan_kompetensi_pengawas_sekolah' => PeningkatanKompetensiPengawasSekolah::first(),
            'peningkatan_kompetensi_tenaga_pendidikan' => PeningkatanKompetensiTenagaPendidikan::first(),
        ]);
    }
}
