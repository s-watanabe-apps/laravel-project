<?php

namespace App\Http\Middleware;

use App\Models\Settings;
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
        $settings = Settings::get();

        if ($settings == null) {
            $settings = new Settings(true);
        }

        $request->merge(['settings' => $settings,]);
        $this->viewFactory->share('settings', $request->settings);

        return $next($request);
    }
}
