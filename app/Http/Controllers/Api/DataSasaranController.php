<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DataSasaran;

class DataSasaranController extends Controller
{
    public function index()
    {
        $data = DataSasaran::latest()->paginate(10);
        return response()->json($data);
    }

    public function show($id)
    {
        $data = DataSasaran::findOrFail($id);
        return response()->json($data);
    }
}