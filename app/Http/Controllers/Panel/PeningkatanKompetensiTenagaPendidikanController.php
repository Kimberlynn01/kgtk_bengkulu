<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\PeningkatanKompetensiTenagaPendidikan;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PeningkatanKompetensiTenagaPendidikanController extends Controller
{
    /**
     * Halaman ini hanya boleh punya maksimal 1 data (singleton).
     * Tidak pakai DataTable/list karena datanya cuma 1 baris.
     */
    public function list()
    {
        $peningkatan_kompetensi_tenaga_pendidikan = PeningkatanKompetensiTenagaPendidikan::first();

        return view('contents.peningkatan_kompetensi_tenaga_pendidikan.list', [
            'title' => 'Peningkatan Kompetensi Tenaga Pendidikan',
            'peningkatan_kompetensi_tenaga_pendidikan' => $peningkatan_kompetensi_tenaga_pendidikan,
        ]);
    }

    public function data()
    {
        $peningkatan_kompetensi_tenaga_pendidikan = PeningkatanKompetensiTenagaPendidikan::first();
        return response()->json(['status' => true, 'data' => $peningkatan_kompetensi_tenaga_pendidikan], 200);
    }

    public function save(Request $request)
    {
        $peningkatan_kompetensi_tenaga_pendidikan = PeningkatanKompetensiTenagaPendidikan::first();

        $rules = [
            'deskripsi' => 'required|string',
            'image' => ($peningkatan_kompetensi_tenaga_pendidikan && $peningkatan_kompetensi_tenaga_pendidikan->image ? 'nullable' : 'required') . '|image|mimes:jpg,jpeg,png,webp|max:20480',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()], 422);
        }

        try {
            return DB::transaction(function () use ($request, $peningkatan_kompetensi_tenaga_pendidikan) {
                $data = $request->only(['deskripsi']);

                if ($request->hasFile('image')) {
                    if ($peningkatan_kompetensi_tenaga_pendidikan && $peningkatan_kompetensi_tenaga_pendidikan->image) {
                        Storage::disk('public')->delete($peningkatan_kompetensi_tenaga_pendidikan->image);
                    }
                    $data['image'] = $request->file('image')->store('peningkatan_kompetensi_tenaga_pendidikans', 'public');
                }

                if ($peningkatan_kompetensi_tenaga_pendidikan) {
                    $peningkatan_kompetensi_tenaga_pendidikan->update($data);
                } else {
                    $peningkatan_kompetensi_tenaga_pendidikan = PeningkatanKompetensiTenagaPendidikan::create($data);
                }

                return response()->json(['status' => true, 'message' => 'Peningkatan Kompetensi Tenaga Pendidikan berhasil disimpan'], 200);
            });
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function delete()
    {
        try {
            return DB::transaction(function () {
                $peningkatan_kompetensi_tenaga_pendidikan = PeningkatanKompetensiTenagaPendidikan::first();
                if ($peningkatan_kompetensi_tenaga_pendidikan) {
                    if ($peningkatan_kompetensi_tenaga_pendidikan->image) {
                        Storage::disk('public')->delete($peningkatan_kompetensi_tenaga_pendidikan->image);
                    }
                    $peningkatan_kompetensi_tenaga_pendidikan->delete();
                }
                return response()->json(['status' => true, 'message' => 'Peningkatan Kompetensi Tenaga Pendidikan berhasil dihapus'], 200);
            });
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }
}
