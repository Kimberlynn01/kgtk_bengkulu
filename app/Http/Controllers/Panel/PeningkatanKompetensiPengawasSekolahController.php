<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\PeningkatanKompetensiPengawasSekolah;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PeningkatanKompetensiPengawasSekolahController extends Controller
{
    /**
     * Halaman ini hanya boleh punya maksimal 1 data (singleton).
     * Tidak pakai DataTable/list karena datanya cuma 1 baris.
     */
    public function list()
    {
        $peningkatan_kompetensi_pengawas_sekolah = PeningkatanKompetensiPengawasSekolah::first();

        return view('contents.peningkatan_kompetensi_pengawas_sekolah.list', [
            'title' => 'Peningkatan Kompetensi Pengawas Sekolah',
            'peningkatan_kompetensi_pengawas_sekolah' => $peningkatan_kompetensi_pengawas_sekolah,
        ]);
    }

    public function data()
    {
        $peningkatan_kompetensi_pengawas_sekolah = PeningkatanKompetensiPengawasSekolah::first();
        return response()->json(['status' => true, 'data' => $peningkatan_kompetensi_pengawas_sekolah], 200);
    }

    public function save(Request $request)
    {
        $peningkatan_kompetensi_pengawas_sekolah = PeningkatanKompetensiPengawasSekolah::first();

        $rules = [
            'deskripsi' => 'required|string',
            'image' => ($peningkatan_kompetensi_pengawas_sekolah && $peningkatan_kompetensi_pengawas_sekolah->image ? 'nullable' : 'required') . '|image|mimes:jpg,jpeg,png,webp|max:20480',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()], 422);
        }

        try {
            return DB::transaction(function () use ($request, $peningkatan_kompetensi_pengawas_sekolah) {
                $data = $request->only(['deskripsi']);

                if ($request->hasFile('image')) {
                    if ($peningkatan_kompetensi_pengawas_sekolah && $peningkatan_kompetensi_pengawas_sekolah->image) {
                        Storage::disk('public')->delete($peningkatan_kompetensi_pengawas_sekolah->image);
                    }
                    $data['image'] = $request->file('image')->store('peningkatan_kompetensi_pengawas_sekolahs', 'public');
                }

                if ($peningkatan_kompetensi_pengawas_sekolah) {
                    $peningkatan_kompetensi_pengawas_sekolah->update($data);
                } else {
                    $peningkatan_kompetensi_pengawas_sekolah = PeningkatanKompetensiPengawasSekolah::create($data);
                }

                return response()->json(['status' => true, 'message' => 'Peningkatan Kompetensi Pengawas Sekolah berhasil disimpan'], 200);
            });
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function delete()
    {
        try {
            return DB::transaction(function () {
                $peningkatan_kompetensi_pengawas_sekolah = PeningkatanKompetensiPengawasSekolah::first();
                if ($peningkatan_kompetensi_pengawas_sekolah) {
                    if ($peningkatan_kompetensi_pengawas_sekolah->image) {
                        Storage::disk('public')->delete($peningkatan_kompetensi_pengawas_sekolah->image);
                    }
                    $peningkatan_kompetensi_pengawas_sekolah->delete();
                }
                return response()->json(['status' => true, 'message' => 'Peningkatan Kompetensi Pengawas Sekolah berhasil dihapus'], 200);
            });
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }
}
