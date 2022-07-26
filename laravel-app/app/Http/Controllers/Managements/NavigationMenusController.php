<?php
namespace App\Http\Controllers\Managements;

use App\Services\NavigationMenusService;
use Illuminate\Http\Request;
//use App\Http\Requests\ManagementsProfilesRequest;

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

    public function index(Request $request)
    {
        $navigationMenus = $this->navigationMenusService->all();

        return view('managements.navigationMenus.index', compact(
            'navigationMenus'
        ));
    }

    public function post(ManagementsProfilesRequest $request)
    {
        echo "<pre>";
        var_dump($request->input());
        exit;
    }
}
