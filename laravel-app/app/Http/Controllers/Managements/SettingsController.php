<?php

namespace App\Http\Controllers\Managements;

use App\Models\Settings;
use App\Http\Requests\AppRequest;
use App\Http\Requests\ManagementsSettingsPostRequest;

class SettingsController extends ManagementsController
{
    public function index(AppRequest $request)
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
