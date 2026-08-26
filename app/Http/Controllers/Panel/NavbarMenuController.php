<?php
// app/Http/Controllers/Panel/NavbarMenuController.php

namespace App\Http\Controllers\Panel;

use App\Models\NavbarMenu;
use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\Navbar\NavbarMenuUpdateRequest;
use Illuminate\Support\Facades\Cache;

class NavbarMenuController extends Controller
{
    public function list()
    {
        $menus = NavbarMenu::topLevel()->with('children')->get();

        return view('contents.navbar-menu.list', [
            'title'      => 'Navbar Front-End',
            'activeSlug' => 'navbar-menu',
            'menus'      => $menus,
        ]);
    }

    public function update(NavbarMenuUpdateRequest $request)
    {
        $validated = $request->validated();

        $menu = NavbarMenu::findOrFail($validated['id']);

        $menu->update([
            'name'      => $validated['name'],
            'is_active' => $request->boolean('is_active'),
        ]);

        Cache::forget('navbar_menu_tree');
        Cache::forget('navbar_menu_tree_api');

        return response()->json(['message' => 'Menu navbar berhasil diperbarui!']);
    }
}