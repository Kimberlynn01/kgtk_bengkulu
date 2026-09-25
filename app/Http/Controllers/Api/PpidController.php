<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PpidVisiMisi;
use App\Models\PpidTugasFungsi;
use Illuminate\Http\Request;

class PpidController extends Controller
{
    public function getVisiMisi()
    {
        $data = PpidVisiMisi::with('images')->get();
        return response()->json($data);
    }

    public function getTugasFungsi()
    {
        $data = PpidTugasFungsi::all();
        return response()->json($data);
    }
}