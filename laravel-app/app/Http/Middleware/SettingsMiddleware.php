<?php

namespace App\Http\Middleware;

use App\Models\Settings;
use Closure;
use Illuminate\Auth\AuthManager;
use Illuminate\View\Factory;
use Illuminate\Support\Facades\Redis;

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
        $cache = null;
        try {
            if (redis()) {
                $cache = Redis::get('settings');
            }
        } catch (Exception $e) {
            //
        }

        if ($cache == null) {
            $settings = (new Settings())->get();

            if ($settings == null) {
                $settings = new Settings(true);
            }

            Redis::set('settings', json_encode($settings));
        } else {
            $settings = new Settings();
            $settings->bind(json_decode($cache));
        }

        $request->merge(['settings' => $settings,]);
        $this->viewFactory->share('settings', $request->settings);

        return $next($request);
    }
}
