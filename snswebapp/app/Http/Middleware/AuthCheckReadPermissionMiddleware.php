<?php
namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use App\Models\Users;
use App\Models\Roles;
use Closure;
use Illuminate\Auth\AuthManager;
use Illuminate\View\Factory;
use Illuminate\Support\Facades\Auth as Authenticate;

class AuthCheckReadPermissionMiddleware
{
    public function __construct(Factory $viewFactory, AuthManager $authManager)
    {
        $this->viewFactory = $viewFactory;
        $this->authManager = $authManager;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Authenticate::check()) {
            if (!$request->settings->anonymous_permission) {
                return redirect('/login')->with('redirect', $request->url());
            }
        }

        return $next($request);
    }
}
