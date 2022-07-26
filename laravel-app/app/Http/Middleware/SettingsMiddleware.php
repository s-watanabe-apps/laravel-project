<?php
namespace App\Http\Middleware;

use App\Services\SettingsService;
use App\Services\NavigationMenusService;
use Closure;
use Illuminate\Auth\AuthManager;
use Illuminate\View\Factory;
use Illuminate\Http\Request;

class SettingsMiddleware
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
    public function handle(Request $request, Closure $next)
    {
        $settings = (new SettingsService())->get();
        $navigations = (new NavigationMenusService())->all();

        $request->merge(compact('settings', 'navigations'));

        $this->viewFactory->share('settings', $request->settings);
        $this->viewFactory->share('navigations', $request->navigations);

        return $next($request);
    }
}
