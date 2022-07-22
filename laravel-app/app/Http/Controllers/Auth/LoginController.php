<?php
namespace App\Http\Controllers\Auth;

use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Libs\Token;
use App\Services\UsersService;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    //use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    // Instance variables.
    private $usersService;

    /**
     * Create a new controller instance.
     *
     * @param App\Services\UsersService
     * @return void
     */
    public function __construct(
        UsersService $usersService
    ) {
        $this->usersService = $usersService;
    }

    /**
     * Perform login processing.
     *
     * @param App\Http\Requests\LoginRequest
     * @return Illuminate\View\View
     */
    public function loginPost(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        $remember = $request->validated()['remember'] ?? 'off';

        if (Auth::attempt($credentials,  $remember === 'on')) {
            //$apiToken = Token::generate();
            //$this->usersService->updateApiToken(Auth::user()->id, $apiToken);

            //$apiToken = hash('sha256', Str::random(80));
            $apiToken = Str::random(80);
            Auth::user()->forceFill([
                'api_token' => $apiToken,
            ])->save();

            $encryptToken = Crypt::encrypt($apiToken);
            Cookie::queue(Cookie::forget('api_token'));
            Cookie::queue('api_token', $encryptToken, '10000000');

            return redirect()->intended($this->redirectTo);
        } else {
            $faild = __('auth.failed');
            return view('login', compact('faild'));
        }
    }

    /**
     * login Get.
     * 
     * @return Illuminate\View\View
     */
    public function loginGet(Request $request)
    {
        $validator = Validator::make([
                'redirect' => $request->session()->get('redirect'),
            ], [
                'redirect' => 'url',
            ]
        );

        return view('login');
    }
}
