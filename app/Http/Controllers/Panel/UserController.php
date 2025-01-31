<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\User\ChangePasswordRequest;
use App\Http\Requests\Panel\User\UserCreateRequest;
use App\Http\Requests\Panel\User\UserUpdateRequest;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function list()
    {
        return view('contents.user.list', [
            'title' => 'Daftar Pengguna',
            'roles' => Role::all(),
            'plugins' => ['datatable']
        ]);
    }

    public function datatable()
    {
        return DataTables::of(User::select('id', 'name', 'email', 'created_at')->with('roles'))
            ->addIndexColumn()
            ->make(true);
    }

    public function store(UserCreateRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $data = $request->validated();
                $data['password'] = Hash::make($data['password']);
                User::create($data);
            });

            return response()->json(['status' => true, 'message' => 'User created successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function update(UserUpdateRequest $request)
    {
        try {
            $user = User::findOrFail($request->id);

            DB::transaction(function () use ($user, $request) {
                $user->fill($request->only(['name', 'username']))->save();
            });

            return response()->json(['status' => true, 'message' => 'User updated successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function switchStatus(Request $request)
    {
        try {
            $user = User::findOrFail($request->id);

            DB::transaction(function () use ($user, $request) {
                $user->update(['is_active' => $request->value]);
            });

            return response()->json(['status' => true, 'message' => 'User status updated'], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function resetPassword(Request $request)
    {
        try {
            $user = User::findOrFail($request->id);
            DB::transaction(fn() => $user->update(['password' => Hash::make(config('app.default_reset'))]));

            return response()->json(['status' => true, 'message' => 'Password reset successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        try {
            $user = User::findOrFail($request->id);
            DB::transaction(fn() => $user->update(['password' => Hash::make($request->password)]));

            return response()->json(['status' => true, 'message' => 'Password changed successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function delete(Request $request)
    {
        try {
            $user = User::findOrFail($request->id);

            DB::transaction(fn() => $user->delete());

            return response()->json(['status' => true, 'message' => 'User deleted successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function updateRole(Request $request)
    {
        try {
            $user = User::findOrFail($request->id);

            DB::transaction(fn() => $user->roles()->sync($request->role_id));

            return response()->json(['status' => true, 'message' => 'User roles updated successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }
}
