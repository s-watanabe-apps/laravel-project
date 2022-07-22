<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    /**
     * index
     *
     * @param  \Illuminate\Http\Request
     * @return void
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
