<?php

namespace App\Http\Middleware;

use Closure;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\AuthManager;
use Illuminate\View\Factory;
use Illuminate\Support\Facades\Auth as Authenticate;

class AuthcheckMiddleware
{
    public function __construct(Factory $viewFactory, AuthManager $authManager)
    {
        $this->viewFactory = $viewFactory;
        $this->authManager = $authManager;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Authenticate::check()) {
            if ($request->settings->anonymous_permission) {
                // Anonymous User
                $user = null;
            } else {
                return redirect('/login')->with('redirect', $request->url());
            }
        } else {
            $user = Authenticate::user();
        }
        
        $request->merge([
            'user' => $user,
        ]);

        $this->viewFactory->share('user', $user);

        return $next($request);
    }
}
