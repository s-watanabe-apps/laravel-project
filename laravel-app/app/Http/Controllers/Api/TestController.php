<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

class TestController extends ApiController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('authcheck');
    }

    /**
     * index Get.
     * 
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $data = $this->user;

        return response()->json($data);
    }
}
