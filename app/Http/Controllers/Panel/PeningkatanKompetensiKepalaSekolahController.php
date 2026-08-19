<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\PeningkatanKompetensiKepalaSekolah;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PeningkatanKompetensiKepalaSekolahController extends Controller
{
    /**
     * Halaman ini hanya boleh punya maksimal 1 data (singleton).
     * Tidak pakai DataTable/list karena datanya cuma 1 baris.
     */
    public function list()
    {
        $peningkatan_kompetensi_kepala_sekolah = PeningkatanKompetensiKepalaSekolah::first();

        return view('contents.peningkatan_kompetensi_kepala_sekolah.list', [
            'title' => 'Peningkatan Kompetensi Kepala Sekolah',
            'peningkatan_kompetensi_kepala_sekolah' => $peningkatan_kompetensi_kepala_sekolah,
        ]);
    }

    public function data()
    {
        $peningkatan_kompetensi_kepala_sekolah = PeningkatanKompetensiKepalaSekolah::first();
        return response()->json(['status' => true, 'data' => $peningkatan_kompetensi_kepala_sekolah], 200);
    }

    public function save(Request $request)
    {
        $peningkatan_kompetensi_kepala_sekolah = PeningkatanKompetensiKepalaSekolah::first();

        $rules = [
            'deskripsi' => 'required|string',
            'image' => ($peningkatan_kompetensi_kepala_sekolah && $peningkatan_kompetensi_kepala_sekolah->image ? 'nullable' : 'required') . '|image|mimes:jpg,jpeg,png,webp|max:20480',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()], 422);
        }

        try {
            return DB::transaction(function () use ($request, $peningkatan_kompetensi_kepala_sekolah) {
                $data = $request->only(['deskripsi']);

                if ($request->hasFile('image')) {
                    if ($peningkatan_kompetensi_kepala_sekolah && $peningkatan_kompetensi_kepala_sekolah->image) {
                        Storage::disk('public')->delete($peningkatan_kompetensi_kepala_sekolah->image);
                    }
                    $data['image'] = $request->file('image')->store('peningkatan_kompetensi_kepala_sekolahs', 'public');
                }

                if ($peningkatan_kompetensi_kepala_sekolah) {
                    $peningkatan_kompetensi_kepala_sekolah->update($data);
                } else {
                    $peningkatan_kompetensi_kepala_sekolah = PeningkatanKompetensiKepalaSekolah::create($data);
                }

                return response()->json(['status' => true, 'message' => 'Peningkatan Kompetensi Kepala Sekolah berhasil disimpan'], 200);
            });
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function delete()
    {
        try {
            return DB::transaction(function () {
                $peningkatan_kompetensi_kepala_sekolah = PeningkatanKompetensiKepalaSekolah::first();
                if ($peningkatan_kompetensi_kepala_sekolah) {
                    if ($peningkatan_kompetensi_kepala_sekolah->image) {
                        Storage::disk('public')->delete($peningkatan_kompetensi_kepala_sekolah->image);
                    }
                    $peningkatan_kompetensi_kepala_sekolah->delete();
                }
                return response()->json(['status' => true, 'message' => 'Peningkatan Kompetensi Kepala Sekolah berhasil dihapus'], 200);
            });
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }
}
