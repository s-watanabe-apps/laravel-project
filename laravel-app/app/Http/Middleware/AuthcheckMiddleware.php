<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use App\Models\Users;
use App\Models\Roles;
use Closure;
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
                $user = new Users();
                $user->id = 0;
                $user->role_id = Roles::ANONYMOUS;
                $user->email = null;
                $user->name = __('strings.anonymous_user_name');
            } else {
                return redirect('/login')->with('redirect', $request->url());
            }
        } else {
            $user = Authenticate::user();
        }
        \Log::info(json_encode($user));
        $request->merge([
            'user' => $user,
        ]);

        $this->viewFactory->share('user', $user);

        return $next($request);
    }
}
