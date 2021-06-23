<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    /**
     * ログアウト
     *
     * @param Request $request
     */
    public function index(Request $request)
    {
        if (Auth::check()) {
            Auth::logout();
        }
        $request->session()->flush();
        return redirect()->intended('/');
    }
}
