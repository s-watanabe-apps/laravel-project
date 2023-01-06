<?php
namespace App\Http\Controllers\Managements;

use App\Models\Informations;
use App\Models\InformationMarks;
use App\Services\InformationsService;
use App\Services\InformationMarksService;
use App\Http\Requests\ManagementsInformationsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InformationsController extends ManagementsController
{
    // Instance variables.
    private $informationsService;
    private $informationMarksService;

    /**
     * Create a new controller instance.
     *
     * @param App\Services\InformationsService
     * @return void
     */
    public function __construct(
        InformationsService $informationsService,
        InformationMarksService $informationMarksService
    ) {
        $this->informationsService = $informationsService;
        $this->informationMarksService = $informationMarksService;
    }

    /**
     * Get information list.
     * 
     * @param Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
        $informations = $this->informationsService->all();

        return view('managements.informations.index', compact('informations'));
    }

    /**
     * Get information.
     * 
     * @param Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function get(Request $request)
    {
        $informations = $this->informationsService->get($request->id);

        $informationMarks = $this->informationMarksService->all();

        return view('managements.informations.edit', compact('informations', 'informationMarks'));
    }

    /**
     * Get create information form.
     * 
     * @param Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function create(Request $request)
    {
        $informationMarks = $this->informationMarksService->all();

        return $this->postView('managements.informations.create', compact('informationMarks'));
    }

    /**
     * Confirmation of input contents.
     * 
     * @param App\Http\Requests\ManagementsInformationsRequest
     * @return Illuminate\View\View
     */
    public function confirm(ManagementsInformationsRequest $request)
    {
        $informations = (new Informations())->bind($request->validated());

        $informationMark = $this->informationMarksService->getById($request->mark_id)->mark;

        $method = $request->method();

        return view('managements.informations.confirm', compact('informations', 'informationMark', 'method'));
    }

    /**
     * Register input information.
     * 
     * @param App\Http\Requests\ManagementsInformationsRequest
     * @return void
     */
    public function register(ManagementsInformationsRequest $request)
    {
        \DB::transaction(function() use($request) {
            $this->informationsService->save($request);
        });

        return redirect()->route('managementsInformations');
    }
}
