<?php

namespace App\Http\Controllers\Managements;

use App\Models\Settings;
use Illuminate\Http\Request;

class SettingsController extends ManagementsController
{
    public function index(Request $request)
    {
        return view('managements.settings.index');
    }

    public function post(Request $request)
    {
        var_dump(1);
        exit;
    }
}
