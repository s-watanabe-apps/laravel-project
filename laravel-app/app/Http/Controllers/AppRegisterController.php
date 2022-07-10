<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\RegisterController;

class AppRegisterController extends RegisterController
{
    /**
     * 登録画面
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function index(AppRequest $request)
    {
        if ($request->isMethod('post')) {
            var_dump('test');
            exit;
        } else {
            return view('loginRegist');
        }
    }
}