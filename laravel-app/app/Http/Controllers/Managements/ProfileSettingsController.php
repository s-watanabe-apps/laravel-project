<?php

namespace App\Http\Controllers\Managements;

use Illuminate\Http\Request;

class ProfileSettingsController extends ManagementsController
{
    public function index(Request $request)
    {
        return view('managements.profileSettings.index');
    }

    public function post(Request $request)
    {
        echo "<pre>";
        var_dump($request->input());
        exit;
    }
}
