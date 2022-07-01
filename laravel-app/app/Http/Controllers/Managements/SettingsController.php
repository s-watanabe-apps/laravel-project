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
        \DB::transaction(function() use ($request) {
            $request->settings->saveSettings($request);
        });

        return redirect()->route('managementsSettings')->with('result', 1);
    }
}
