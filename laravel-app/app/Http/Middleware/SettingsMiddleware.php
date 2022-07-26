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
        $navigations = (new NavigationMenusService())->all();

        $request->merge([
            'settings' => $settings,
            'navigations' => $navigations,
        ]);

        $this->viewFactory->share('settings', $request->settings);
        $this->viewFactory->share('navigations', $request->navigations);

        return $next($request);
    }
}
