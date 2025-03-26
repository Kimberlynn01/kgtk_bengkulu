<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Profil;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $profil = Profil::where('user_id', '=', $user->id)
            ->first();

        $data = [
            'title' => 'Profil',
            'user'  => $user,
            'profil' => $profil
        ];

        return view('contents.profil.list', $data);
    }

    public function store(Request $request)
    {
        try {
            $id = decrypt($request->id);

            // Validasi input
            $validatedData = $request->validate([
                'nama_lengkap' => 'required|string|max:255',
                'tempat_lahir' => 'required|string|max:255',
                'tanggal_lahir' => 'required|date',
                'email' => 'required|email|unique:users,email,' . $id,
                'no_hp' => [
                    'required',
                    'regex:/^(\+62|62|08)[0-9]{9,13}$/u'
                ],
                'alamat' => 'required|string|max:500'
            ],[
                'nama_lengkap.required' => 'Nama Lengkap wajib diisi',
                'tempat_lahir.required' => 'Tempat Lahir wajib diisi',
                'tanggal_lahir.required' => 'Tanggal Lahir wajib diisi',
                'email.required' => 'Email wajib diisi',
                'email.email' => "Tambahkan '@' untuk alamat Email",
                'email.unique' => 'Email sudah digunakan',
                'no_hp.required' => 'No HP wajib diisi',
                'no_hp.regex' => 'Format No HP tidak valid',
                'alamat.required' => 'Alamat wajib diisi',
                'alamat.max' => 'Isian Alamat maksimal 500 karakter',
            ]);

            // Simpan atau update profil
            $profil = Profil::updateOrCreate(
                ['user_id' => $id],
                $validatedData
            );

            // Update nama & email user
            User::where('id', $id)->update([
                'name' => $validatedData['nama_lengkap'],
                'email' => $validatedData['email']
            ]);

            return response()->json([
                'success' => true,
                'message' => $profil->wasRecentlyCreated ? 'Data berhasil ditambahkan' : 'Data berhasil diupdate'
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors' => $e->errors() // Berisi semua pesan error validasi
            ], 422);
        }
    }
}
