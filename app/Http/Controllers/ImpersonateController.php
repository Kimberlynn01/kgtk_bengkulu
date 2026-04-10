<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImpersonateController extends Controller
{
    // Start
    public function start($id)
    {
        $userToImpersonate = User::findOrFail($id);

        // Only For Super Admin
        if (session('role_name') !== 'Super Admin') {
            abort(403);
        }

        // Save ID Admin In Session
        session([
            'is_impersonate' => true,
            'impersonate_id' => Auth::id(),
            'impersonate_back_url' => url()->previous(),
        ]);


        // Login As User Target
        Auth::login($userToImpersonate);

        // Multi Role
        if ($userToImpersonate->multi_role) {
            session([
                'user_id' => $userToImpersonate->id,
                'multi_role' => true,
                'role_id' => null,
                'role_name' => null,
            ]);

            return redirect()->route('view-role')->with('message', 'Silakan pilih peran untuk melanjutkan.');
        }

        // Single Role
        session([
            'user_id' => $userToImpersonate->id,
            'role_id' => $userToImpersonate->role_id,
            'role_name' => $userToImpersonate->role_name,
            'multi_role' => false,
        ]);

        return redirect(route('dashboard'))->with('message', 'Now impersonating as ' . $userToImpersonate->name);
    }

    // Stop
    public function stop(Request $request)
    {
        $originalId = session('impersonate_id');
        $backUrl = session('impersonate_back_url', route('dashboard'));

        if (!$originalId) {
            return redirect(route('dashboard'))->with('error', 'Not impersonating any user.');
        }

        $originalUser = User::find($originalId);
        Auth::login($originalUser);

        session()->forget([
            'impersonate_id',
            'user_id',
            'role_id',
            'role_name',
            'lembaga_id',
            'lembaga_nama',
            'lembaga_kode_prop',
            'lembaga_kode_kab',
            'lembaga_kode_prop',
        ]);

        session([
            'user_id' => $originalUser->id,
            'role_id' => 1,
            'role_name' => 'Super Admin'
        ]);

        return redirect($backUrl)->with('message', 'Kembali ke akun admin.');
    }
}
