<?php
namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use App\Models\Users;
use App\Models\Roles;
use Closure;
use Illuminate\Auth\AuthManager;
use Illuminate\View\Factory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

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
        //dump($request->cookie());
        //$apiToken = Crypt::decrypt($request->cookie('api_token'), true);

        if (!Auth::check()) {
            $apiToken = Crypt::decrypt($request->cookie('api_token'), true);
            if (!is_null($apiToken)) {
                // リフレッシュ
                
            }

            if (!$request->settings['anonymous_permission']) {
                return redirect('/login')->with('redirect', $request->url());
            }
        }

        return $next($request);
    }
}

// AWS S3へファイルアップロード
