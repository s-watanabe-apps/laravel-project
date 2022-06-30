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
            $settings = $request->settings;
            $settings->site_name = $request->site_name;
            $settings->site_description = $request->site_description;
            $settings->user_create_any = $request->user_create_any ?? 0;
            $settings->user_create_member = $request->user_create_member ?? 0;
            $settings->basic_auth = $request->basic_auth;
            $settings->basic_user = $request->basic_user ?? null;
            $settings->basic_password = $request->basic_password ?? null;
            $settings->anonymous_permisshon = $request->anonymous_permisshon;
            $settings->save();
        });

        return redirect()->route('managementsSettings')->with('result', 1);
    }
}
