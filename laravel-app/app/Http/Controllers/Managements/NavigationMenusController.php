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
        $navigationMenus = $this->navigationMenusService->all();

        return view('managements.navigationMenus.index', compact(
            'navigationMenus'
        ));
    }

    /**
     * Register input information.
     * 
     * @param App\Http\Requests\ManagementsNavigationsRequest
     * @return void
     */
    public function register(ManagementsNavigationsRequest $request)
    {
        echo "<pre>";
        var_dump($request->input());
        exit;
    }
}
