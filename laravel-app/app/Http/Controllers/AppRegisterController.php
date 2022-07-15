<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\RegisterController;

class AppRegisterController extends RegisterController
{
    /**
     * 登録画面
     *
     * @param  Illuminate\Http\Request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if ($request->isMethod('post')) {
            var_dump('test');
            exit;
        } else {
            return view('loginRegist');
        }
    }
}