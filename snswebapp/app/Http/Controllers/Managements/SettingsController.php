<?php
namespace App\Http\Controllers\Managements;

use App\Services\SettingsService;
use App\Http\Requests\ManagementsSettingsRequest;
use Illuminate\Http\Request;

class SettingsController extends ManagementsController
{
    // Instance variables.
    private $profilesService;

    /**
     * Create a new controller instance.
     *
     * @param App\Services\SettingsService
     * @return void
     */
    public function __construct(SettingsService $settingsService)
    {
        $this->settingsService = $settingsService;
    }

    /**
     * Get setting list.
     * 
     * @param Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
        dump(auth()->user()->id);
        return view('managements.settings.index');
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
