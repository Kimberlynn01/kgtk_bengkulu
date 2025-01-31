<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\{Action, Menu, MenuRole, Role};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class OtoritasController extends Controller
{
    public function index()
    {
        return view('contents.otoritas.list', ['title' => 'Otoritas']);
    }

    public function data()
    {
        $roles = Role::select('id', 'name', 'slug_name', 'created_at')->where('is_active', 1);
        return DataTables::of($roles)->addIndexColumn()->make();
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|unique:roles,name']);

        return DB::transaction(function () use ($request) {
            $role = Role::create([
                'name' => $request->name,
                'slug_name' => Str::snake($request->name),
                'is_active' => 1,
            ]);

            return response()->json(['status' => (bool) $role], 200);
        }, 400);
    }

    public function update(Request $request)
    {
        $request->validate(['name' => ['required', Rule::unique('roles', 'name')->ignore($request->id)]]);

        return DB::transaction(function () use ($request) {
            $role = Role::findOrFail($request->id);
            $role->update(['name' => $request->name, 'slug_name' => Str::snake($request->name)]);
            return response()->json(['status' => true], 200);
        }, 400);
    }

    public function delete(Request $request)
    {
        return DB::transaction(function () use ($request) {
            $role = Role::findOrFail($request->id);
            $deleted = $role->delete();
            return response()->json(['status' => $deleted], 200);
        }, 400);
    }

    public function formPermission($slug)
    {
        $role = Role::where('slug_name', $slug)->firstOrFail();
        return view('contents.otoritas.permissions', [
            'title' => 'Pengaturan Hak Akses',
            'menus' => $this->getMenu($role->id),
            'actions' => Action::all(),
            'role' => $role,
        ]);
    }

    public function submitPermission(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                MenuRole::where('role_id', $request->role_id)->delete();
                $permissions = collect($request->except('_token', 'role_id'))
                    ->keys()
                    ->map(function ($key) {
                        [$menu_id,, $action_id] = explode('_', $key);
                        return ['menu_id' => $menu_id, 'action_id' => $action_id];
                    });

                Role::findOrFail($request->role_id)->menus()->attach($permissions);
            });

            return redirect()->route('otoritas')->with('affected', 0);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('otoritas')->with('error', 'Failed to update permissions.');
        }
    }

    public function getMenu($role_id, $parent_id = null)
    {
        return Menu::where('parent_id', $parent_id)
            ->with(['permissions' => function ($query) use ($role_id) {
                $query->select('menu_id', 'role_id', DB::raw('GROUP_CONCAT(action_id) as action'))
                    ->where('role_id', $role_id)
                    ->groupBy('menu_id', 'role_id');
            }])
            ->orderBy('created_at')
            ->get()
            ->map(function ($menu) use ($role_id) {
                $menu->child = $this->getMenu($role_id, $menu->id);
                $menu->actions = isset($menu->permissions) ? explode(',', $menu->permissions->action) : [];
                unset($menu->permissions);
                return $menu;
            });
    }
}
