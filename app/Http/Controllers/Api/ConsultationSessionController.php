<?php

namespace App\Http\Controllers\Api;

use App\Models\ConsultationSession;
use App\Http\Controllers\Controller;

class ConsultationSessionController extends Controller
{
    public function show()
    {
        $session = ConsultationSession::where('is_active', true)->first();

        if (!$session) {
            return response()->json([
                'success' => false,
                'message' => 'Belum ada sesi konsultasi yang aktif.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'title'       => $session->title,
                'slug'        => $session->slug,
                'description' => $session->description,
                'gmeet_link'  => $session->gmeet_link,
                'image'       => $session->image ? asset('storage/' . $session->image) : null,
            ],
        ]);
    }
}