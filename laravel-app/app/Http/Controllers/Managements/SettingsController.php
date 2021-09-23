<?php

namespace App\Http\Controllers\Managements;

use App\Models\Settings;
use App\Http\Requests\ManagementsSettingsPostRequest;
use Illuminate\Http\Request;

class SettingsController extends ManagementsController
{
    public function index(Request $request)
    {
        return view('managements.settings.index');
    }

    public function post(ManagementsSettingsPostRequest $request)
    {
        var_dump($request->basic_user);
        exit;
    }
}
