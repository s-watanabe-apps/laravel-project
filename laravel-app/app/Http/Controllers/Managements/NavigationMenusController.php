<?php
namespace App\Http\Controllers\Managements;

use App\Services\NavigationMenusService;
use App\Http\Requests\ManagementsNavigationsRequest;
use Illuminate\Http\Request;

class NavigationMenusController extends ManagementsController
{
    // Instance variables.
    private $navigationMenusService;

    /**
     * Create a new controller instance.
     *
     * @param App\Services\NavigationMenusService
     * @return void
     */
    public function __construct(NavigationMenusService $navigationMenusService)
    {
        $this->navigationMenusService = $navigationMenusService;
    }

    /**
     * Get create navigation menu form.
     * 
     * @param Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('managements.navigationMenus.index');
    }

    /**
     * Register input information.
     * 
     * @param App\Http\Requests\ManagementsNavigationsRequest
     * @return void
     */
    public function register(ManagementsNavigationsRequest $request)
    {
        \DB::transaction(function() use ($request) {
            $this->navigationMenusService->save($request->validated());
        });

        return redirect()->route('managementsNavigations')->with('result', 1);
    }
}
