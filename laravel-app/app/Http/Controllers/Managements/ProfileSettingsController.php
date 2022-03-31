<?php

namespace App\Http\Controllers\Managements;

use App\Libs\InputType;
use App\Models\Profiles;
use Illuminate\Http\Request;

class ProfileSettingsController extends ManagementsController
{
    public function index(Request $request)
    {
        $types = InputType::getTypes();

        $profiles = Profiles::getProfiles();

        return view('managements.profileSettings.index', compact(
            'types', 'profiles'
        ));
    }

    public function post(Request $request)
    {
        echo "<pre>";
        var_dump($request->input());
        exit;
    }
}
