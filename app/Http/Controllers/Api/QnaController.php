<?php

namespace App\Http\Controllers\Api;

use App\Models\Qna;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class QnaController extends Controller
{

    public function ask(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'instansi' => 'required|string|max:255',
            'phone' => 'required|numeric',
            'category' => [
                'required',
                Rule::in(['ppg', 'bcks', 'pkgbk', 'pkgsd mbi', 'stem', 'pm/kka', 'ukkj', 'gpk mahir', 'bcps', 'sekolah model']),
            ],
            'question' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors'  => $validator->errors()
            ], 422);
        }

        try {
            $qna = Qna::create($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Pertanyaan Anda berhasil dikirim! Mohon tunggu jawaban dari Admin.',
                'data'    => $qna
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengirim pertanyaan.',
                'error'   => $e->getMessage()
            ], 500);
        }
    }
}
