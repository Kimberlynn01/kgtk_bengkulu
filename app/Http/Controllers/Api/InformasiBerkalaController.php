<?php

namespace App\Http\Controllers\Api;

use App\Models\InformasiBerkala;
use App\Http\Controllers\Controller;

class InformasiBerkalaController extends Controller
{
    public function index()
    {
        $data = InformasiBerkala::latest()->get();

        return response()->json([
            'success' => true,
            'data' => $data->map(function ($item) {
                return [
                    'id'           => $item->id,
                    'nama_dokumen' => $item->nama_dokumen,
                    'tahun'        => $item->tahun,
                    'file'         => $item->file ? asset('storage/' . $item->file) : null,
                ];
            }),
        ]);
    }

    public function show($id)
    {
        $item = InformasiBerkala::find($id);

        if (!$item) {
            return response()->json([
                'success' => false,
                'message' => 'Informasi berkala tidak ditemukan.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'id'           => $item->id,
                'nama_dokumen' => $item->nama_dokumen,
                'tahun'        => $item->tahun,
                'file'         => $item->file ? asset('storage/' . $item->file) : null,
            ],
        ]);
    }
}