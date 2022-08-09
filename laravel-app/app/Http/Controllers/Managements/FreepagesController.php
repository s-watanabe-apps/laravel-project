<?php
namespace App\Http\Controllers\Managements;

use App\Models\FreePages;
use App\Services\FreePagesService;
use App\Http\Requests\ManagementsFreepagesRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class FreepagesController extends ManagementsController
{
    // Instance variables.
    private $freePagesService;

    /**
     * Create a new controller instance.
     *
     * @param App\Services\FreePagesService
     * @return void
     */
    public function __construct(FreePagesService $freePagesService)
    {
        $this->freePagesService = $freePagesService;
    }

    /**
     * Get free page list.
     * 
     * @param Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
        $freePages = $this->freePagesService->all();

        return view('managements.freepages.index', compact('freePages'));
    }

    /**
     * Get free page.
     * 
     * @param Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function get(Request $request)
    {
        $freePages = $this->freePagesService->find($request->id);

        return view('managements.freepages.edit', compact('freePages'));
    }

    /**
     * Get create free page form.
     * 
     * @param Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function create(Request $request)
    {
        $code = Str::random(32);

        return view('managements.freepages.create', compact('code'));
    }

    /**
     * Confirmation of input contents.
     * 
     * @param App\Http\Requests\ManagementsFreepagesRequest
     * @return Illuminate\View\View
     */
    public function confirm(ManagementsFreepagesRequest $request)
    {
        $freePages = (new FreePages())->bind($request->validated());

        $method = $request->method();

        $tabIndex = $request->isPost() ? 1 : 2;

        return view('managements.freepages.confirm', compact('freePages', 'method', 'tabIndex'));
    }

    /**
     * Register input information.
     * 
     * @param App\Http\Requests\ManagementsInformationsRequest
     * @return void
     */
    public function register(ManagementsFreepagesRequest $request)
    {
        \DB::transaction(function() use ($request) {
            if ($request->isPost()) {
                $this->freePagesService->save($request);
            } else if ($request->isPut()) {

            } else {
                abort(404);
            }
        });

        return redirect()->route('managementsFreepages');
    }
}
