<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class CustomBasicAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->settings->basic_auth) {
            return $next($request);
        }

        $user = $request->getUser();
        $password = $request->getPassword();
        if (
            $user == $request->settings->basic_user && $password == $request->settings->basic_password
        ) {
            return $next($request);
        }

        $headers = ['WWW-Authenticate' => 'Basic'];
        return new Response('Authorization Required', 401, $headers);
    }
}
