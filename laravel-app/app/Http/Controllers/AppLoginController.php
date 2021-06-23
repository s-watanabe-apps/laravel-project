<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;

class AppLoginController extends LoginController
{
    /**
     * ログイン画面
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if ($request->isMethod('post')) {
            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                return redirect()->intended('/');
            } else {
                return view('login');
            }
        } else {
            return view('login');
        }
    }

    /**
     * 登録画面
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function regist(Request $request)
    {
        if ($request->isMethod('post')) {
            var_dump('test');
            exit;
        } else {
            return view('loginRegist');
        }
    }
}