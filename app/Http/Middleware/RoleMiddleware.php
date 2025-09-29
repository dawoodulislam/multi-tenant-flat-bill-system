<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        $user = $request->user();
        if (! $user) {
            abort(401);
        }

        // If using Spatie, replace with $user->hasRole($role)
        if (! method_exists($user, 'hasRole')) {
            // fallback: if Role relationship exists and user->roles collection is loaded
            if (! $user->roles || ! $user->roles->pluck('name')->contains($role)) {
                abort(403, 'Forbidden (role)');
            }
        } else {
            if (! $user->hasRole($role)) {
                abort(403, 'Forbidden (role)');
            }
        }

        return $next($request);
    }
}
