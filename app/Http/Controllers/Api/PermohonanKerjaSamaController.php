<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PermohonanKerjaSama;

class PermohonanKerjaSamaController extends Controller
{
    public function index()
    {
        $data = PermohonanKerjaSama::latest()->first();
        return response()->json($data ? $data : null);
    }
}