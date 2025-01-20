<?php

namespace App\Http\Middleware;

use App\Models\Action;
use App\Models\MenuRole;
use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class RbacCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $slug, $action_id = 1): Response
    {
        $role_id = session('role_id');
        if (empty($role_id)) {
            return redirect()->route('view-role');
        }
        $check = $this->rbacCheck($slug, $action_id);
        if ($check == false)
            abort(403, 'Access Forbidden');

        $actions = Action::all();
        $permissions = [];
        foreach ($actions as $action) {
            $permissions[$action->name] = $this->rbacCheck($slug, $action->id);
        }
        View::share('permissions', $permissions);
        View::share('activeSlug', $slug);

        $roles = Role::all();
        $role_id = session('role_id');
        $access_roles = [];
        foreach ($roles as $role) {
            $access_roles[$role->slug_name] = $role->id == $role_id ? true : false;
        }
        View::share('access_roles', $access_roles);
        return $next($request);
    }

    function rbacCheck($slug, $action_id)
    {
        $role_id = session('role_id');
        $check = MenuRole::where([
            'role_id' => $role_id,
            'action_id' => $action_id,
        ])->whereHas('menu', function ($query) use ($slug) {
            $query->where('slug_name', $slug);
        })->first();

        if (empty($check)) {
            return false;
        }

        return true;
    }
}
