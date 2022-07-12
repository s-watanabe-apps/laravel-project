<?php

namespace App\Http\Controllers\Managements;

use App\Models\Settings;
use App\Http\Requests\AppRequest;
use App\Http\Requests\ManagementsSettingsPostRequest;

class SettingsController extends ManagementsController
{
    /**
     * Get setting list.
     * 
     * @param App\Http\Requests\ManagementsInformationsPostRequest
     * @return Illuminate\View\View
     */
    public function index(AppRequest $request)
    {
        return view('managements.settings.index');
    }

    /**
     * Register input information.
     * 
     * @param App\Http\Requests\ManagementsInformationsPostRequest
     * @return Illuminate\View\View
     */
    public function register(ManagementsSettingsPostRequest $request)
    {
        \DB::transaction(function() use ($request) {
            $request->settings->saveSettings($request);
        });

        return redirect()->route('managementsSettings')->with('result', 1);
    }
}
