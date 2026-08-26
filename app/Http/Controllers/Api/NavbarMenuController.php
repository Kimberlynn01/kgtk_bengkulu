<?php

namespace App\Http\Controllers\Api;

use App\Models\NavbarMenu;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class NavbarMenuController extends Controller
{
    public function index()
    {
        $menus = Cache::remember('navbar_menu_tree_api', 3600, function () {
            return NavbarMenu::topLevel()
                ->active()
                ->with('children')
                ->get();
        });

        return response()->json([
            'success' => true,
            'data'    => $this->transform($menus),
        ]);
    }

    private function transform($menus)
    {
        return $menus->map(function ($menu) {
            return [
                'id'       => $menu->id,
                'name'     => $menu->name,
                'slug'     => $menu->slug,
                'path'     => $menu->path,
                'icon'     => $menu->icon,
                'is_group' => is_null($menu->path),
                'children' => $this->transform(
                    $menu->children->where('is_active', true)->values()
                ),
            ];
        })->values();
    }
}