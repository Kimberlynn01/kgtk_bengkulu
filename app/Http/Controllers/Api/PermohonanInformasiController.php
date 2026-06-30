<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PermohonanInformasi;

class PermohonanInformasiController extends Controller
{
    public function index()
    {
        $data = PermohonanInformasi::latest()->first();
        return response()->json($data ? $data : null);
    }
}