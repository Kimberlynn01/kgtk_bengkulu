<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Berita;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $articles = Artikel::with('images')->latest()->take(3)->get();
        $news = Berita::with('images')->latest()->take(4)->get();

        return view('landing', compact('articles', 'news'));
    }
}
