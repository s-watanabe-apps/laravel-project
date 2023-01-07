<?php
namespace App\Http\Controllers;

use App\Services\FreePagesService;
use Illuminate\Http\Request;

class PageController extends Controller
{
    // Instance variables.
    private $freePagesService;

    /**
     * Create a new controller instance.
     *
     * @param App\Services\FreePagesService
     * @return void
     */
    public function __construct(
        FreePagesService $freePagesService
    ) {
        $this->freePagesService = $freePagesService;
    }
    
    /**
     * Get free page.
     * 
     * @param Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function get(Request $request)
    {
        $freePages = $this->freePagesService->getByCode($request->code);

        return view('page.index', compact(
            'freePages'
        ));
    }
}
