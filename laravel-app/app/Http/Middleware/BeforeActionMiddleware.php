<?php
namespace App\Http\Middleware;

use App\Models\Settings;
use App\Services\MessagesService;
use App\Libs\DateFormat;
use Closure;
use Illuminate\Auth\AuthManager;
use Illuminate\View\Factory;
use Illuminate\Support\Facades\Auth;

class BeforeActionMiddleware
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
        $this->viewFactory->share('dateFormat', new DateFormat(\App::getLocale()));

        if (isset($request->user->id)) {
            $receiveMessages = (new MessagesService())->getUnreadMessages($request->user->id);
            $this->viewFactory->share('receiveMessages', $receiveMessages);    
        }

        return $next($request);
    }
}
