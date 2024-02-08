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
     * コンストラクタ.
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
     * お知らせ一覧取得.
     * 
     * @param Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
        $validator = Validator::make([
            'keyword' => $request->keyword,
            'm' => $request->m,
            'page' => $request->page,
            'sort' => $request->sort,
        ], [
            'keyword' => 'string|nullable',
            'm' => 'string|nullable',
            'page' => 'integer|nullable',
            'sort' => 'integer|nullable|min:-5|max:5',
        ]);
        if ($validator->fails()) {
            abort(404);
        }

        $validated = $validator->validated();

        $page = $validated['page'] ?? 1;
        list($informations, $headers) = $this->informationsService->get_all_informations($validated['keyword'], $validated['m'], $validated['sort']);
        $informations = $this->pager($informations, 10, $page, '/managements/informations/');

        $marks = $this->informationMarksService->get_all();

        return view('managements.informations.index', compact(
            'informations',
            'headers',
            'marks',
            'validated'
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

        $informations = new Informations();

        return view('managements.informations.create', compact('informations', 'informationMarks'));
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
