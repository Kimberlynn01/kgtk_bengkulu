<?php

namespace App\Http\Controllers;

use App\Models\MenuGroup;
use Illuminate\Http\Request;

class UtilityController extends Controller
{
    public function loadMenu(Request $request)
    {
        try {
            $data = [];
            $role_id = session('role_id');
            $menus = MenuGroup::select('id', 'name')
                ->has('menus')
                ->with(['menus' => function ($query) use ($role_id) {
                    $query->whereHas('roles', function ($query2) use ($role_id) {
                        $query2->where('role_id', $role_id);
                        $query2->where('action_id', 1);
                    });
                    $query->with('childs');
                    $query->orderBy('menu_order', 'asc');
                }])
                ->get();
            return response()->json(['data' => $menus], 200);
        } catch (\Exception $e) {
            return response()->json(['data' => $e->getMessage()], 400);
        }
    }
}
