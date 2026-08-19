<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\PeningkatanGuru;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PeningkatanGuruController extends Controller
{
    /**
     * Halaman ini hanya boleh punya maksimal 1 data (singleton).
     * Tidak pakai DataTable/list karena datanya cuma 1 baris.
     */
    public function list()
    {
        $peningkatan_guru = PeningkatanGuru::first();

        return view('contents.peningkatan_guru.list', [
            'title' => 'Peningkatan Guru',
            'peningkatan_guru' => $peningkatan_guru,
        ]);
    }

    public function data()
    {
        $peningkatan_guru = PeningkatanGuru::first();
        return response()->json(['status' => true, 'data' => $peningkatan_guru], 200);
    }

    public function save(Request $request)
    {
        $peningkatan_guru = PeningkatanGuru::first();

        $rules = [
            'deskripsi' => 'required|string',
            'image' => ($peningkatan_guru && $peningkatan_guru->image ? 'nullable' : 'required') . '|image|mimes:jpg,jpeg,png,webp|max:20480',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()], 422);
        }

        try {
            return DB::transaction(function () use ($request, $peningkatan_guru) {
                $data = $request->only(['deskripsi']);

                if ($request->hasFile('image')) {
                    if ($peningkatan_guru && $peningkatan_guru->image) {
                        Storage::disk('public')->delete($peningkatan_guru->image);
                    }
                    $data['image'] = $request->file('image')->store('peningkatan_gurus', 'public');
                }

                if ($peningkatan_guru) {
                    $peningkatan_guru->update($data);
                } else {
                    $peningkatan_guru = PeningkatanGuru::create($data);
                }

                return response()->json(['status' => true, 'message' => 'Peningkatan Guru berhasil disimpan'], 200);
            });
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function delete()
    {
        try {
            return DB::transaction(function () {
                $peningkatan_guru = PeningkatanGuru::first();
                if ($peningkatan_guru) {
                    if ($peningkatan_guru->image) {
                        Storage::disk('public')->delete($peningkatan_guru->image);
                    }
                    $peningkatan_guru->delete();
                }
                return response()->json(['status' => true, 'message' => 'Peningkatan Guru berhasil dihapus'], 200);
            });
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }
}
