<?php
namespace App\Http\Controllers\Managements;

use App\Services\SettingsService;
use App\Services\HeaderImagesService;
use App\Http\Requests\ManagementsSettingsRequest;
use Illuminate\Http\Request;

class SettingsController extends ManagementsController
{
    // Instance variables.
    private $profilesService;
    private $headerImagesService;

    /**
     * Create a new controller instance.
     *
     * @param App\Services\SettingsService
     * @param App\Services\HeaderImagesService
     * @return void
     */
    public function __construct(
        SettingsService $settingsService,
        HeaderImagesService $headerImagesService)
    {
        $this->settingsService = $settingsService;
        $this->headerImagesService = $headerImagesService;
    }

    /**
     * Get setting list.
     * 
     * @param Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
        $headers = $this->headerImagesService->get();

        return view('managements.settings.index', compact('headers'));
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
