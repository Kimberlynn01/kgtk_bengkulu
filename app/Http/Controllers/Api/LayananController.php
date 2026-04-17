<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\InformasiProgram;
use App\Models\Kemitraan;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    public function getInformasiPrograms()
    {
        $data = InformasiProgram::with('files')->get();
        return response()->json($data);
    }

    public function getKemitraans()
    {
        $data = Kemitraan::with('files')->get();
        return response()->json($data);
    }
}
