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
     * ナビゲーションメニュー取得.
     * 
     * @param Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('managements.navigationMenus.index');
    }

    /**
     * ナビゲーションメニュー更新.
     * 
     * @param App\Http\Requests\ManagementsNavigationsRequest
     * @return void
     */
    public function save(ManagementsNavigationsRequest $request)
    {
        $params = $request->validated();

        \DB::transaction(function() use ($params) {
            $this->navigationMenusService->save($params);
        });

        return redirect()->route('managementsNavigations')->with('result', 1);
    }
}
