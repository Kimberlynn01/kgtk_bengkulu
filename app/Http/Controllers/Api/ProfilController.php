<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\VisiMisi;
use App\Models\TugasFungsi;
use App\Models\TimKerja;
use App\Models\JanjiMaklumat;
use App\Models\ProfilPejabat;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function getVisiMisi()
    {
        $data = VisiMisi::with('images')->get();
        return response()->json($data);
    }

    public function getTugasFungsi()
    {
        $data = TugasFungsi::all();
        return response()->json($data);
    }

    public function getTimKerja()
    {
        $data = TimKerja::with('images')->get();
        return response()->json($data);
    }

    public function getJanjiMaklumat()
    {
        $data = JanjiMaklumat::with('images')->get();
        return response()->json($data);
    }

    public function getProfilPejabat()
    {
        $data = ProfilPejabat::with('images')->get();
        return response()->json($data);
    }
}
