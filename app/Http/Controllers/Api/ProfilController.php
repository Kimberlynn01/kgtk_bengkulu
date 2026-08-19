<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\VisiMisi;
use App\Models\TugasFungsi;
use App\Models\TimKerja;
use App\Models\JanjiMaklumat;
use App\Models\ProfilPejabat;
use App\Models\Sejarah;
use App\Models\PerilakuCoreValue;
use App\Models\RencanaStrategis;
use App\Models\PerjanjianKerja;
use App\Models\LaporanKerja;
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
    public function getSejarahs()
    {
        $data = Sejarah::latest()->get();
        return response()->json($data);
    }

    public function getSejarah($id)
    {
        $data = Sejarah::findOrFail($id);
        return response()->json($data);
    }

    public function getPerilakuCoreValues()
    {
        $data = PerilakuCoreValue::latest()->get();
        return response()->json($data);
    }

    public function getPerilakuCoreValue($id)
    {
        $data = PerilakuCoreValue::findOrFail($id);
        return response()->json($data);
    }

    public function getRencanaStrategis()
    {
        $data = RencanaStrategis::latest()->get();
        return response()->json($data);
    }

    public function getRencanaStrategisDetail($id)
    {
        $data = RencanaStrategis::findOrFail($id);
        return response()->json($data);
    }

    public function getPerjanjianKerja()
    {
        $data = PerjanjianKerja::latest()->get();
        return response()->json($data);
    }

    public function getPerjanjianKerjaDetail($id)
    {
        $data = PerjanjianKerja::findOrFail($id);
        return response()->json($data);
    }

    public function getLaporanKerja()
    {
        $data = LaporanKerja::latest()->get();
        return response()->json($data);
    }

    public function getLaporanKerjaDetail($id)
    {
        $data = LaporanKerja::findOrFail($id);
        return response()->json($data);
    }
}
