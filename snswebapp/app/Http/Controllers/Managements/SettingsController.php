<?php
namespace App\Http\Controllers\Managements;

use App\Services\SettingsService;
use App\Services\HeaderImagesService;
use App\Services\LoginImagesService;
use App\Services\ThemesService;
use App\Http\Requests\ManagementsSettingsRequest;
use Illuminate\Http\Request;

class SettingsController extends ManagementsController
{
    // Instance variables.
    private $profilesService;
    private $headerImagesService;
    private $loginImagesService;
    private $themesService;

    /**
     * Create a new controller instance.
     *
     * @param App\Services\SettingsService
     * @param App\Services\HeaderImagesService
     * @param App\Services\LoginImagesService
     * @param App\Services\ThemesService
     * @return void
     */
    public function __construct(
        SettingsService $settingsService,
        HeaderImagesService $headerImagesService,
        LoginImagesService $loginImagesService,
        ThemesService $themesService)
    {
        $this->settingsService = $settingsService;
        $this->headerImagesService = $headerImagesService;
        $this->loginImagesService = $loginImagesService;
        $this->themesService = $themesService;
    }

    /**
     * サイト設定取得.
     * 
     * @param Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
        $headerImages = $this->headerImagesService->get();

        $loginImages = $this->loginImagesService->get();

        $themes = $this->themesService->all();
        
        return view('managements.settings.index', compact(
            'headerImages',
            'loginImages',
            'themes'
        ));
    }

    /**
     * サイト設定更新.
     * 
     * @param App\Http\Requests\ManagementsInformationsRequest
     * @return void
     */
    public function save(ManagementsSettingsRequest $request)
    {
        $params = $request->validated();
        
        \DB::transaction(function() use ($params) {
            $this->settingsService->save($params);
        });

        return redirect()->route('managementsSettings')->with('result', 1);
    }
}
