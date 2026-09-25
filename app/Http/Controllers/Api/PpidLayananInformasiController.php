<?php

namespace App\Http\Controllers\Api;

use App\Models\PpidLayananInformasi;
use App\Http\Controllers\Controller;

class PpidLayananInformasiController extends Controller
{
    public function index()
    {
        $data = PpidLayananInformasi::latest()->get();

        if ($data->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Data Layanan Informasi belum tersedia.',
                'data'    => null,
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data Layanan Informasi berhasil diambil.',
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
        $item = PpidLayananInformasi::find($id);

        if (!$item) {
            return response()->json([
                'success' => false,
                'message' => 'Data Layanan Informasi tidak ditemukan.',
                'data'    => null,
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data Layanan Informasi berhasil diambil.',
            'data' => [
                'id'           => $item->id,
                'nama_dokumen' => $item->nama_dokumen,
                'tahun'        => $item->tahun,
                'file'         => $item->file ? asset('storage/' . $item->file) : null,
            ],
        ], 200);
    }
}