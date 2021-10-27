<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleCheck
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role = null)
    {

        if (($role == null && Auth::user()->tokenCan('admin')) || ($role == 'admin' && Auth::user()->role == 'A')) {
            return $next($request);
        }

        if ($role == null)
            return response(['Message' => 'Access denied!'], 401);

        return redirect('dashboard');

    }
}
