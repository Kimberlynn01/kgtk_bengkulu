<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            // Cari user termasuk yang sudah soft delete
            $user = User::withTrashed()->where('email', $googleUser->getEmail())->first();

            if ($user) {
                if ($user->trashed()) {
                    // Jika akun sudah dinonaktifkan
                    return redirect()->route('login')->with('message', 'Akun Anda telah dinonaktifkan dan tidak bisa login.');
                }

                // Login jika akun aktif
                Auth::login($user);
            } else {
                // Jika akun belum ada, buat baru
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'username' => explode('@', $googleUser->getEmail())[0],
                    'password' => bcrypt(Str::random(24)),
                    'is_active' => '1',
                ]);

                $id = $user->id;
                $id_role = 2;

                $user = User::with('roles')->find($id);
                $user->roles()->sync($id_role);

                Auth::login($user);
            }

            return redirect()->intended('dashboard');
        } catch (\Exception $e) {
            return redirect()->route('login')->with('message', 'Terjadi kesalahan saat login dengan Google.');
        }
    }
}
