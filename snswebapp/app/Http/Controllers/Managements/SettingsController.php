<?php
namespace App\Http\Controllers\Managements;

use App\Services\SettingsService;
use App\Services\HeaderImagesService;
use App\Services\LoginImagesService;
use App\Http\Requests\ManagementsSettingsRequest;
use Illuminate\Http\Request;

class SettingsController extends ManagementsController
{
    // Instance variables.
    private $profilesService;
    private $headerImagesService;
    private $loginImagesService;

    /**
     * Create a new controller instance.
     *
     * @param App\Services\SettingsService
     * @param App\Services\HeaderImagesService
     * @param App\Services\LoginImagesService
     * @return void
     */
    public function __construct(
        SettingsService $settingsService,
        HeaderImagesService $headerImagesService,
        LoginImagesService $loginImagesService)
    {
        $this->settingsService = $settingsService;
        $this->headerImagesService = $headerImagesService;
        $this->loginImagesService = $loginImagesService;
    }

    /**
     * Get setting list.
     * 
     * @param Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
        $headerImages = $this->headerImagesService->get();
dump($headerImages);

        $loginImages = $this->loginImagesService->get();

        return view('managements.settings.index', compact(
            'headerImages', 'loginImages'
        ));
    }

    /**
     * Register input information.
     * 
     * @param App\Http\Requests\ManagementsInformationsRequest
     * @return void
     */
    public function register(ManagementsSettingsRequest $request)
    {
        \DB::transaction(function() use ($request) {
            $this->settingsService->save($request);
        });

        return redirect()->route('managementsSettings')->with('result', 1);
    }
}
