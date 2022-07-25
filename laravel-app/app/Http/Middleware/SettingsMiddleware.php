<?php
namespace App\Http\Middleware;

use App\Models\Settings;
use App\Services\NavigationMenusService;
use Closure;
use Illuminate\Auth\AuthManager;
use Illuminate\View\Factory;

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
    public function handle($request, Closure $next)
    {
        $settings = (new Settings())->get();
        $navigationMenus = (new NavigationMenusService())->all();

        $request->merge([
            'settings' => $settings,
            'navigationMenus' => $navigationMenus,
        ]);

        $this->viewFactory->share('settings', $request->settings);
        $this->viewFactory->share('navigationMenus', $request->navigationMenus);

        return $next($request);
    }
}
