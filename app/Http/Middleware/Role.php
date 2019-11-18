<?php

namespace App\Http\Middleware;

use Closure;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string $role
     * @return mixed
     */
    public function handle($request, Closure $next , string $role)
    {
        if ($role != auth()->user()->role)
            return api_response(null,['user' => ["you must be {$role} to access this action-"]]);
        return $next($request);
    }
}
