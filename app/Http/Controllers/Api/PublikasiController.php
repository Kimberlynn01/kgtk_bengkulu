<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use App\Models\Berita;
use App\Models\Skm;
use App\Models\HasilSurvey;
use Illuminate\Http\Request;

class PublikasiController extends Controller
{
    public function getArtikels()
    {
        $data = Artikel::with('images')->latest('date')->paginate(10);
        return response()->json($data);
    }

    public function getArtikel($id)
    {
        $data = Artikel::with('images')->findOrFail($id);
        return response()->json($data);
    }

    public function getBeritas()
    {
        $data = Berita::with('images')->latest('date')->paginate(10);
        return response()->json($data);
    }

    public function getBerita($id)
    {
        $data = Berita::with('images')->findOrFail($id);
        return response()->json($data);
    }

    public function getSkms()
    {
        $data = Skm::latest()->paginate(10);
        return response()->json($data);
    }

    public function getHasilSurveys()
    {
        $data = HasilSurvey::latest()->paginate(10);
        return response()->json($data);
    }
}
