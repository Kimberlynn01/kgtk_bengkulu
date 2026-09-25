<?php

namespace App\Http\Controllers\Api;

use App\Models\PpidDaftarInformasiPublik;
use App\Http\Controllers\Controller;

class PpidDaftarInformasiPublikController extends Controller
{
    public function index()
    {
        $data = PpidDaftarInformasiPublik::latest()->get();

        if ($data->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Data Daftar Informasi Publik belum tersedia.',
                'data'    => null,
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data Daftar Informasi Publik berhasil diambil.',
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
        $item = PpidDaftarInformasiPublik::find($id);

        if (!$item) {
            return response()->json([
                'success' => false,
                'message' => 'Data Daftar Informasi Publik tidak ditemukan.',
                'data'    => null,
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data Daftar Informasi Publik berhasil diambil.',
            'data' => [
                'id'           => $item->id,
                'nama_dokumen' => $item->nama_dokumen,
                'tahun'        => $item->tahun,
                'file'         => $item->file ? asset('storage/' . $item->file) : null,
            ],
        ], 200);
    }
}