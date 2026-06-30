<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PermohonanSaranaPrasarana;

class PermohonanSaranaPrasaranaController extends Controller
{
    public function index()
    {
        $data = PermohonanSaranaPrasarana::latest()->first();
        
        return response()->json($data ? $data : null);
    }
}