<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\MenuGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class MenusController extends Controller
{
    public function index(Request $request)
    {
        return view('contents.menu.list', [
            'title' => 'Manajemen Menu',
            'menuGroups' => MenuGroup::all(),
        ]);
    }

    public function data(Request $request)
    {
        $list = Menu::select(DB::raw('id, parent_id, name, slug_name, icon, link, created_at, menu_group_id'))->with('parents');

        return DataTables::of($list)
            ->addIndexColumn()
            ->addColumn('menu_type', function ($row) {
                if (empty($row->parent_id)) return 'main';

                return 'child';
            })
            ->addColumn('full_link', function ($row) {
                if (empty($row->link)) return '-';
                return url($row->link);
            })
            ->make();
    }

    public function getMainMenu()
    {
        $list = Menu::select(DB::raw('id, name as text'))->where('parent_id', null)->get();

        return response()->json(['data' => $list]);
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'menu_type' => 'required|in:main,child',
            'link' => 'required_if:menu_type,child|nullable',
            'icon' => 'required_if:menu_type,main|nullable|string|max:255',
            'menu_group_id' => 'required_if:menu_type,main|nullable|exists:menu_groups,id',
            'parent_id' => 'required_if:menu_type,child|nullable|exists:menus,id',
        ], [
            'name.required' => 'Nama menu wajib diisi.',
            'menu_type.required' => 'Jenis menu wajib diisi.',
            'link.required_if' => 'Link wajib diisi untuk submenu.',
            'icon.required_if' => 'Ikon wajib diisi untuk menu utama.',
            'menu_group_id.required_if' => 'Grup menu wajib diisi untuk menu utama.',
            'parent_id.required_if' => 'Menu induk wajib diisi untuk submenu.',
        ]);

        try {
            $menu_type = $request->menu_type;
            $slug_name = Str::snake($request->name);

            // Determine the menu order
            $menu_order = Menu::count() + 1;

            $menu_data = [
                'name' => $request->name,
                'slug_name' => $slug_name,
                'link' => $request->link,
                'is_active' => 1,
                'menu_order' => $menu_order,
            ];

            if ($menu_type === 'main') {
                $menu_data['icon'] = $request->icon;
                $menu_data['menu_group_id'] = $request->menu_group_id;
            } elseif ($menu_type === 'child') {
                $parent = Menu::find($request->parent_id);
                if (!$parent) {
                    return response()->json(['status' => false, 'msg' => 'Parent menu not found.'], 404);
                }
                $menu_data['parent_id'] = $request->parent_id;
                $menu_data['menu_order'] = $parent->menu_order;
            }

            // Create the menu
            $menu = Menu::create($menu_data);

            return response()->json(['status' => true, 'menu' => $menu], 201);
        } catch (\Exception $e) {
            // Log the exception for debugging
            Log::error('Menu creation failed: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json(['status' => false, 'msg' => 'An error occurred while creating the menu.'], 500);
        }
    }


    public function update(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'id' => 'required|exists:menus,id',
            'name' => 'required|string|max:255',
            'menu_type' => 'required|in:main,child',
            'link' => 'required_if:menu_type,child|nullable',
            'icon' => 'required_if:menu_type,main|nullable|string|max:255',
            'menu_group_id' => 'required_if:menu_type,main|nullable|exists:menu_groups,id',
            'parent_id' => 'required_if:menu_type,child|nullable|exists:menus,id',
        ], [
            'id.required' => 'ID menu wajib diisi.',
            'id.exists' => 'Menu tidak ditemukan.',
            'name.required' => 'Nama menu wajib diisi.',
            'menu_type.required' => 'Jenis menu wajib diisi.',
            'link.required_if' => 'Link wajib diisi untuk submenu.',
            'icon.required_if' => 'Ikon wajib diisi untuk menu utama.',
            'menu_group_id.required_if' => 'Grup menu wajib diisi untuk menu utama.',
            'parent_id.required_if' => 'Menu induk wajib diisi untuk submenu.',
        ]);

        try {
            $menu = Menu::find($request->id);

            if (!$menu) {
                return response()->json(['status' => false, 'msg' => 'Menu tidak ditemukan.'], 404);
            }

            // Update menu based on its type
            $menu->name = $request->name;
            $menu->link = $request->link;

            if ($request->menu_type === 'main') {
                $menu->icon = $request->icon;
                $menu->menu_group_id = $request->menu_group_id;
            } elseif ($request->menu_type === 'child') {
                $menu->parent_id = $request->parent_id;
            }

            // Save only if there are changes
            if ($menu->isDirty()) {
                $menu->save();
                return response()->json(['status' => true, 'msg' => 'Menu berhasil diperbarui.'], 200);
            }

            return response()->json(['status' => false, 'msg' => 'Tidak ada perubahan pada menu.'], 200);
        } catch (\Exception $e) {
            // Log the exception for debugging
            Log::error('Gagal memperbarui menu: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json(['status' => false, 'msg' => 'Terjadi kesalahan saat memperbarui menu.'], 500);
        }
    }

    public function delete(Request $request)
    {
        $menu_id = $request->id;

        try {
            $menu = Menu::find($menu_id);

            $menu->delete();

            if ($menu->trashed()) {
                return response()->json(['status' => true], 200);
            }
            return response()->json(['status' => false], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }
}
