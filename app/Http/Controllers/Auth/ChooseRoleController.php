<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SelectRoleRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ChooseRoleController extends Controller
{
    /**
     * Display the choose role view.
     */
    public function create(Request $request)
    {
        $user = User::with('roles')->find(Auth::id());

        if (count($user->roles) == 1) {
            $request->session()->put('role_id', $user->roles[0]->id);
            $request->session()->put('role_name', $user->roles[0]->name);
            $request->session()->put('multi_role', false);
            return redirect()->route('dashboard');
        }

        return view('auth.roles', [
            'user' => $user,
        ]);
    }

    /**
     * Handle the incoming chosen role request
     */
    public function store(SelectRoleRequest $request)
    {
        $role_id = $request->role_id;

        $role = Role::find($role_id);

        $request->session()->put('role_id', $role->id);
        $request->session()->put('role_name', $role->name);
        $request->session()->put('multi_role', true);

        return redirect()->route('dashboard');
    }
}
