<?php
namespace App\Http\Controllers\Managements;

use App\Libs\ProfileInputType;
use App\Services\ProfilesService;
use Illuminate\Http\Request;
use App\Http\Requests\ManagementsProfilesRequest;

class ProfileSettingsController extends ManagementsController
{
    // Instance variables.
    private $profilesService;

    /**
     * Create a new controller instance.
     *
     * @param App\Services\ProfilesService
     * @return void
     */
    public function __construct(ProfilesService $profilesService)
    {
        $this->profilesService = $profilesService;
    }

    /**
     * プロフィール設定項目取得.
     */
    public function index(Request $request)
    {
        $types = ProfileInputType::getTypes();

        $profiles = $this->profilesService->getProfileItems();

        return view('managements.profileSettings.index', compact(
            'types', 'profiles'
        ));
    }

    public function save(ManagementsProfilesRequest $request)
    {
        echo "<pre>";
        var_dump($request->input());
        exit;
    }
}
