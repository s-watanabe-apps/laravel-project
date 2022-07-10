<?php

namespace App\Http\Controllers\Managements;

use App\Libs\ProfileInputType;
use App\Models\Profiles;
use App\Http\Requests\AppRequest;
use App\Http\Requests\ManagementsProfilePostRequest;

class ProfileSettingsController extends ManagementsController
{
    public function index(AppRequest $request)
    {
        $types = ProfileInputType::getTypes();

        $profiles = Profiles::getProfiles();

        return view('managements.profileSettings.index', compact(
            'types', 'profiles'
        ));
    }

    public function post(ManagementsProfilePostRequest $request)
    {
        echo "<pre>";
        var_dump($request->input());
        exit;
    }
}
