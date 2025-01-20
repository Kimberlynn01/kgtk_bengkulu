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
    function list()
    {
        $roles = Role::all();

        return view('contents.user.list', [
            'title' => 'Daftar Pengguna',
            'roles' => $roles,
            'plugins' => ['datatable']
        ]);
    }

    function datatable()
    {
        $query = User::select('id', 'name', 'email', 'created_at')
            ->with('roles');

        return DataTables::of($query)
            ->addIndexColumn()
            ->make(true);
    }

    function store(UserCreateRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $validatedData = $request->validated();

                $validatedData['password'] = Hash::make($validatedData['password']);

                User::create($validatedData);
            });

            return response()->json([
                'status' => true,
                'message' => 'ok'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 400);
        }
    }

    function update(UserUpdateRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $user = User::find($request->id);

                $user->name = $request->name;
                $user->username = $request->username;

                if ($user->isDirty()) {
                    $user->save();
                }
            });
            return response()->json([
                'status' => true,
                'message' => 'ok'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 400);
        }
    }

    function switchStatus(Request $request)
    {
        try {
            $user = User::find($request->id);

            if (empty($user)) {
                throw new Exception("User tidak ditemukan", 1);
            }

            DB::transaction(function () use ($user, $request) {
                $user->is_active = $request->value;

                if ($user->isDirty('is_active')) {
                    $user->save();
                }
            });

            return response()->json([
                'status' => true,
                'message' => 'ok'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 400);
        }
    }

    function resetPassword(Request $request)
    {
        try {
            $user = User::find($request->id);

            if (empty($user)) {
                throw new Exception("User tidak ditemukan", 1);
            }

            DB::transaction(function () use ($user) {
                $user->password = Hash::make(config('app.default_reset'));

                if ($user->isDirty('password')) {
                    $user->save();
                }
            });

            return response()->json([
                'status' => true,
                'message' => 'ok'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 400);
        }
    }

    function changePassword(ChangePasswordRequest $request)
    {
        try {
            $user = User::find($request->id);

            if (empty($user)) {
                throw new Exception("User tidak ditemukan", 1);
            }

            DB::transaction(function () use ($user, $request) {
                $user->password = Hash::make($request->password);

                if ($user->isDirty('password')) {
                    $user->save();
                }
            });

            return response()->json([
                'status' => true,
                'message' => 'ok'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 400);
        }
    }

    public function delete(Request $request)
    {
        try {
            $user = User::find($request->id);

            if (empty($user)) {
                throw new Exception("User tidak ditemukan", 1);
            }

            DB::transaction(function () use ($user) {
                $user->delete();

                if ($user->trashed()) {
                    return response()->json([
                        'status' => true,
                        'message' => 'ok'
                    ], 200);
                } else {
                    throw new Exception("Terjadi kesalahan saat menghapus data", 1);
                }
            });
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'msg' => $e->getMessage()
            ], 400);
        }
    }

    public function updateRole(Request $request)
    {
        try {
            $user_id = $request->id;
            $role_id = $request->role_id;

            $user = User::with('roles')->find($user_id);

            DB::transaction(function () use ($user, $role_id) {
                $user->roles()->sync($role_id);
            });

            return response()->json([
                'status' => true,
                'message' => 'ok'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'msg' => $e->getMessage()
            ], 400);
        }
    }
}
