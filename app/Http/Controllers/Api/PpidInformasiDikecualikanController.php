<?php

namespace App\Http\Controllers\Api;

use App\Models\PpidInformasiDikecualikan;
use App\Http\Controllers\Controller;

class PpidInformasiDikecualikanController extends Controller
{
    public function index()
    {
        $data = PpidInformasiDikecualikan::latest()->get();

        if ($data->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Data Informasi Dikecualikan belum tersedia.',
                'data'    => null,
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data Informasi Dikecualikan berhasil diambil.',
            'data' => $data->map(function ($item) {
                return [
                    'id'           => $item->id,
                    'nama_dokumen' => $item->nama_dokumen,
                    'tahun'        => $item->tahun,
                    'file'         => $item->file ? asset('storage/' . $item->file) : null,
                ];
            }),
        ], 200);
    }

    public function show($id)
    {
        $item = PpidInformasiDikecualikan::find($id);

        if (!$item) {
            return response()->json([
                'success' => false,
                'message' => 'Data Informasi Dikecualikan tidak ditemukan.',
                'data'    => null,
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data Informasi Dikecualikan berhasil diambil.',
            'data' => [
                'id'           => $item->id,
                'nama_dokumen' => $item->nama_dokumen,
                'tahun'        => $item->tahun,
                'file'         => $item->file ? asset('storage/' . $item->file) : null,
            ],
        ], 200);
    }
}