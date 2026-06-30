<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PermohonanNarasumber;

class PermohonanNarasumberController extends Controller
{
    public function index()
    {
        $data = PermohonanNarasumber::latest()->first();
        return response()->json($data ? $data : null);
    }
}