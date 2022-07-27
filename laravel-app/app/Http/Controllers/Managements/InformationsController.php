<?php
namespace App\Http\Controllers\Managements;

use App\Models\Informations;
use App\Models\InformationMarks;
use App\Services\InformationsService;
use App\Http\Requests\ManagementsInformationsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InformationsController extends ManagementsController
{
    // Instance variables.
    private $informationsService;

    /**
     * Create a new controller instance.
     *
     * @param App\Services\InformationsService
     * @return void
     */
    public function __construct(InformationsService $informationsService)
    {
        $this->informationsService = $informationsService;
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
var_dump(carbon());
        return view('managements.informations.index', compact(
            'informations'
        ));
    }

    /**
     * Get information.
     * 
     * @param Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function get(Request $request)
    {
        $information = $this->informationsService->get($request->id);

        $informationMarks = InformationMarks::get();

        $method = 'put';

        return view('managements.informations.editor', compact(
            'information', 'informationMarks', 'method'
        ));
    }

    /**
     * Get create information form.
     * 
     * @param Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function create(Request $request)
    {
        $informationMarks = $this->informationsService->get();

        $method = 'post';

        return view('managements.informations.editor', compact(
            'informationMarks', 'method'
        ));
    }


    /**
     * Confirmation of input contents.
     * 
     * @param App\Http\Requests\ManagementsInformationsRequest
     * @return Illuminate\View\View
     */
    public function confirm(ManagementsInformationsRequest $request)
    {
        $method = $request->method();

        return view('managements.informations.viewer', compact(
            'request', 'method'
        ));
    }

    /**
     * Register input information.
     * 
     * @param App\Http\Requests\ManagementsInformationsRequest
     * @return void
     */
    public function register(ManagementsInformationsRequest $request)
    {
        \DB::transaction(function() use ($request) {
            if ($request->isPost()) {
                $this->informationsService->add($request->validated());
            } else {

            }
        });

        return redirect()->route('managementsInformations');
    }
}
