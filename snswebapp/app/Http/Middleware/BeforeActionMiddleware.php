<?php
namespace App\Http\Middleware;

use App\Models\Settings;
use App\Services\MessagesService;
use App\Services\WeathersService;
use App\Services\ArticleLabelsService;
use Closure;
use Illuminate\Auth\AuthManager;
use Illuminate\View\Factory;
use Illuminate\Support\Facades\Auth as Authenticate;
use Illuminate\Support\Facades\Validator;

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
        // 言語設定
        $lang = 'en';
        if (substr($request->header('accept-language'), 0, 2) == 'ja') {
            $lang = 'ja';
        }
        \App::setLocale($lang);

        // メニュー開閉状態設定
        $cookie = $request->header('cookie');
        preg_match('/user-menus=(show|hide)/', $cookie, $user_menus_matchs);
        $user_menus_status = $user_menus_matchs[1] ?? 'show';
        preg_match('/admin-menus=(show|hide)/', $cookie, $admin_menus_matchs);
        $admin_menus_status = $admin_menus_matchs[1] ?? 'show';
        
        // 地域情報取得
        $cities = [
            ['id' => 1, 'name' => '東京', 'code' => 'Tokyo'],
        ];

        // 受信メッセージ取得
        $receive_messages = [];
        if (Authenticate::check()) {
            $receive_messages = (new MessagesService())->get_unread_messages(user()->id);
        }

        // 日付指定パラメータ取得
        $validator = Validator::make([
            'date' => $request->date,
        ], [
            'date' => 'date|nullable',
        ]);
        if ($validator->fails()) {
            abort(422);
        }

        if (!($date = $validator->validated()['date'])) {
            $date = date('Y-m-d');
        }

        // お天気情報取得
        $weathers = (new WeathersService())->get_weathers(1850144, $date);

        // キーワード取得
        $feature_tags = array_map(function($label) use($date){
            $label['frame_color'] = '#dddddd';
            $label['body_color'] = '#eeeeee';
            return $label;
        }, (new ArticleLabelsService())->get_feature_tags($date));

        $this->viewFactory->share(compact(
            'lang',
            'user_menus_status',
            'admin_menus_status',
            'date',
            'cities',
            'weathers',
            'receive_messages',
            'feature_tags'
        ));

        $request->cookie('user-menus', $user_menus_status);
        $request->cookie('admin-menus', $admin_menus_status);

        return $next($request);
    }
}
