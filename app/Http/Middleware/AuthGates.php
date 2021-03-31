<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Role;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Cache;

class AuthGates
{
    public function handle($request, Closure $next)
    {
        $user = \Auth::user();

        if ($user) {
            //Cacahe roles with permissions for one month.
            $roles            = Cache::remember('role-permissions', 2629743, function () {
                return Role::with('permissions')->get();
            });

            $permissionsArray = [];

            foreach ($roles as $role) {
                foreach ($role->permissions as $permissions) {
                    $permissionsArray[$permissions->title][] = $role->id;
                }
            }

            foreach ($permissionsArray as $title => $roles) {
                Gate::define($title, function ($user) use ($roles) {
                    return count(array_intersect($user->roles->pluck('id')->toArray(), $roles)) > 0;
                });
            }
        }

        return $next($request);
    }
}