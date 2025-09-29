<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Building;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureOwnerAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        if (!$user) {
            abort(401);
        }

        // Admin bypasses owner restrictions
        if ($user->hasRole('admin')) {
            return $next($request);
        }

        // For owners only, ensure if route has building/flat/bill param that belongs to this owner
        $params = $request->route()->parameters();

        // check building
        if (isset($params['building'])) {
            $building = $params['building'] instanceof Building ? $params['building'] : Building::find($params['building']);
            if (!$building || $building->owner_id !== $user->id) {
                abort(403, 'Unauthorized - building');
            }
        }

        // check flat -> load flat's owner_id
        if (isset($params['flat'])) {
            $flat = $params['flat'];
            if (!is_object($flat)) {
                $flat = \App\Models\Flat::find($flat);
            }
            if (!$flat || $flat->owner_id !== $user->id) {
                abort(403, 'Unauthorized - flat');
            }
        }

        // check bill
        if (isset($params['bill'])) {
            $bill = $params['bill'];
            if (!is_object($bill)) {
                $bill = \App\Models\Bill::find($bill);
            }
            if (!$bill || $bill->owner_id !== $user->id) {
                abort(403, 'Unauthorized - bill');
            }
        }

        return $next($request);
    }
}
