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
            $role_id = $request->role_id;

            $actions = Action::all();
            $menus = Menu::all();
            $role = Role::find($role_id);

            DB::transaction(function () use ($role_id, $role, $actions, $menus, $request) {
                MenuRole::where([
                    'role_id' => $role_id,
                ])->delete();

                $menuRoleData = [];

                // Collect the menu-role-action combinations to attach
                foreach ($menus as $menu) {
                    $actionIds = [];

                    foreach ($actions as $action) {
                        $request_name = $menu->id . '_' . $role->id . '_' . $action->id;

                        // If the request contains the specific menu and action, add the action id
                        if ($request->has($request_name)) {
                            $actionIds[] = $action->id;
                        }
                    }

                    // If there are any actions for this menu, add them to the array
                    if (!empty($actionIds)) {
                        foreach ($actionIds as $actionId) {
                            $menuRoleData[$menu->id][] = ['action_id' => $actionId];
                        }
                    }
                }

                // Sync each menu with its respective actions for the role
                foreach ($menuRoleData as $menu_id => $actions) {
                    foreach ($actions as $action) {
                        $role->menus()->attach($menu_id, $action);
                    }
                }
            });

            return redirect()->route('otoritas')->with('affected', true);
        } catch (\Exception $e) {
            return redirect()->route('otoritas')->with('error', $e->getMessage());
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
