<?php
namespace App\Http\Controllers\Managements;

use App\Libs\ProfileInputType;
use App\Services\ProfilesService;
use App\Services\SettingsService;
use Illuminate\Http\Request;
use App\Http\Requests\ManagementsProfilesRequest;

class ProfileSettingsController extends ManagementsController
{
    // サービス変数.
    private $settingsService;
    private $profilesService;

    /**
     * コンストラクタ.
     *
     * @param App\Services\SettingsService
     * @param App\Services\ProfilesService
     * @return void
     */
    public function __construct(
        SettingsService $settingsService,
        ProfilesService $profilesService
    ) {
        $this->settingsService = $settingsService;
        $this->profilesService = $profilesService;
    }

    /**
     * プロフィール設定項目取得.
     * 
     * @param Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
        $settings = $request->settings;

        $types = ProfileInputType::getTypes();

        $profiles = $this->profilesService->getProfileItems();

        return view('managements.profileSettings.index', compact(
            'settings',
            'types',
            'profiles'
        ));
    }

    /**
     * プロフィール設定項目保存.
     * 
     * @param App\Http\Requests\ManagementsProfilesRequest
     */
    public function save(ManagementsProfilesRequest $request)
    {
        $validated = $request->validated();

        \DB::transaction(function() use ($validated) {
            $this->settingsService->saveProfileFixedItems($validated);
        });

        echo "<pre>";
        var_dump($request->validated());
        exit;
    }
}
