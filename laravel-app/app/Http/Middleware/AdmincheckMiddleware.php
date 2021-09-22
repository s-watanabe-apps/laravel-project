<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Roles;

class AdmincheckMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->user->role_id != Roles::ADMIN) {
            abort(404);
        }

        return $next($request);
    }
}
