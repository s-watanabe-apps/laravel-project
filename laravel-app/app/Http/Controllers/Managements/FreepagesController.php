<?php

namespace App\Http\Controllers\Managements;

use App\Services\FreePagesService;
use App\Http\Requests\ManagementsFreepagesPostRequest;
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

        return view('managements.freepages.index', compact(
            'freePages'
        ));
    }

    /**
     * Get free page.
     * 
     * @param Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function get(Request $request)
    {
        $freePage = $this->freePagesService->find($request->id);

        $values = $freePage->getAttributes();

        $index = 1;

        return view('managements.freepages.editor', compact(
            'values', 'index'
        ));
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

        $index = 2;

        return view('managements.freepages.editor', compact(
            'code', 'index'
        ));
    }

    /**
     * Confirmation of input contents.
     * 
     * @param App\Http\Requests\ManagementsFreepagesPostRequest
     * @return Illuminate\View\View
     */
    public function confirm(ManagementsFreepagesPostRequest $request)
    {
        $values = $request->validated();

        return view('managements.freepages.viewer', compact(
            'values',
        ));
    }

    /**
     * Register input information.
     * 
     * @param App\Http\Requests\ManagementsInformationsPostRequest
     * @return void
     */
    public function register(ManagementsFreepagesPostRequest $request)
    {

        \DB::transaction(function() use ($request) {
            if ($request->isPost()) {
                $this->freePagesService->add($request->validated());
            } else {

            }
        });

        return redirect()->route('managementsFreepages');
    }
}
