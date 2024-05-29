<?php
namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use App\Models\Users;
use App\Models\Roles;
use Closure;
use Illuminate\Auth\AuthManager;
use Illuminate\View\Factory;
use Illuminate\Support\Facades\Auth as Authenticate;
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
        dump($request->cookie('api_token'));
        $apiToken = Crypt::decrypt($request->cookie('api_token'), true);
        dump($apiToken);
        dump(Authenticate::check());

        $client = new Client(['base_uri' => env('APP_URL')]);
        $response = $client->request('GET', '/api/user', [
            'headers' => [
                'Authorization' => 'Bearer ' . $request->cookie('api_token'),
                'Accept' => 'application/json',
            ],
        ]);
        dump($response);
        exit;

        if (!Authenticate::check()) {
            if (!$request->settings['anonymous_permission']) {
                return redirect('/login')->with('redirect', $request->url());
            }
        }

        return $next($request);
    }
}
