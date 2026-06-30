<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\StrukturOrganisasi;

class StrukturOrganisasiController extends Controller
{
    public function index()
    {
        $data = StrukturOrganisasi::latest()->paginate(10);
        return response()->json($data);
    }

    public function show($id)
    {
        $data = StrukturOrganisasi::findOrFail($id);
        return response()->json($data);
    }
}