<?php
namespace App\Http\Controllers\Managements;

use App\Services\GroupsService;
use Illuminate\Http\Request;

class GroupsController extends ManagementsController
{
    // Instance variables.
    private $groupsService;

    /**
     * Create a new controller instance.
     *
     * @param App\Services\GroupsService
     * @return void
     */
    public function __construct(
        GroupsService $groupsService
    ) {
        $this->groupsService = $groupsService;
    }

    /**
     * Get group List.
     * 
     * @param Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
        $groups = $this->groupsService->all();

        return view('managements.groups.index', compact(
            'groups'
        ));
    }
}
