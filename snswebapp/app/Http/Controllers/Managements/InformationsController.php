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
     * お知らせ取得.
     * 
     * @param Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function get(Request $request)
    {
        $informations = $this->informationsService->get_by_id($request->id);

        $marks = $this->informationMarksService->get_all();

        return view('managements.informations.view', compact(
            'informations',
            'marks'
        ));
    }

    /**
     * お知らせ新規作成.
     * 
     * @param Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function create(Request $request)
    {
        $marks = $this->informationMarksService->get_all();

        return view('managements.informations.create', compact(
            'marks'
        ));
    }

    /**
     * 入力内容確認.
     * 
     * @param App\Http\Requests\ManagementsInformationsRequest
     * @return Illuminate\View\View
     */
    public function confirm(ManagementsInformationsRequest $request)
    {
        $values = $request->validated();

        $mark = $this->informationMarksService->get_by_id($request->mark_id);

        if ($request->isPost()) {
            return view('managements.informations.createConfirm', compact(
                'values',
                'mark'
            ));
        } else if ($request->isPut()) {
            return view('managements.informations.editConfirm', compact(
                'mark'
            ));
        } else {
            abort(404);
        }
    }

    /**
     * Register input information.
     * 
     * @param App\Http\Requests\ManagementsInformationsRequest
     * @return void
     */
    public function save(ManagementsInformationsRequest $request)
    {
        \DB::transaction(function() use($request) {
            $this->informationsService->save($request);
        });

        return redirect()->route('managementsInformations');
    }
}
