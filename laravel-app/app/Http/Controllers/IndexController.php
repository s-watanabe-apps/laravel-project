<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class IndexController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        echo "<pre>";
        var_dump(Auth::user()->name);
        var_dump(Auth::user()->email);
        return view('index', array('user' => Auth::user(),));
    }
}
