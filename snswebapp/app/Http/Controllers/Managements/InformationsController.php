<?php
namespace App\Http\Controllers\Managements;

use App\Models\Informations;
use App\Models\InformationCategories;
use App\Services\InformationsService;
use App\Services\InformationCategoriesService;
use App\Http\Requests\ManagementsInformationsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InformationsController extends ManagementsController
{
    // サービス変数.
    private $informationsService;
    private $informationCategoriesService;

    /**
     * コンストラクタ.
     *
     * @param App\Services\InformationsService
     * @param App\Services\InformationCategoriesService
     * @return void
     */
    public function __construct(
        InformationsService $informationsService,
        InformationCategoriesService $informationCategoriesService
    ) {
        $this->informationsService = $informationsService;
        $this->informationCategoriesService = $informationCategoriesService;
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
            'category_id' => $request->category_id,
            'page' => $request->page,
            'sort' => $request->sort,
        ], [
            'keyword' => 'string|nullable',
            'category_id' => 'integer|nullable',
            'page' => 'integer|nullable',
            'sort' => 'integer|nullable|min:-5|max:5',
        ]);
        if ($validator->fails()) {
            abort(404);
        }

        $validated = $validator->validated();

        $page = $validated['page'] ?? 1;
        list($informations, $headers) = $this->informationsService->getInformations(
            $validated['keyword'], $validated['category_id'], $validated['sort']);
        $informations = $this->pager($informations, 10, $page, '/managements/informations/');

        $categories = $this->informationCategoriesService->getAll();

        return view('managements.informations.index', compact(
            'informations',
            'headers',
            'categories',
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
        $values = $this->informationsService->getById($request->id);

        return view('managements.informations.view', compact(
            'values'
        ));
    }

    /**
     * お知らせ削除確認.
     *
     * @param Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function delete(Request $request)
    {
        $values = $this->informationsService->getById($request->id);

        return view('managements.informations.deleteConfirm', compact(
            'values'
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
        $categories = $this->informationCategoriesService->getAll();

        return view('managements.informations.create', compact(
            'categories'
        ));
    }

    /**
     * 新規作成入力内容確認.
     *
     * @param App\Http\Requests\ManagementsInformationsRequest
     * @return Illuminate\View\View
     */
    public function createConfirm(ManagementsInformationsRequest $request)
    {
        $values = $request->validated();

        $category = $this->informationCategoriesService->getById($request->category_id);

        $values['style'] = $category['style'];

        return view('managements.informations.createConfirm', compact(
            'values',
            'category'
        ));
    }


    /**
     * 更新入力内容確認.
     *
     * @param App\Http\Requests\ManagementsInformationsRequest
     * @return Illuminate\View\View
     */
    public function editConfirm(ManagementsInformationsRequest $request)
    {
        $values = $request->validated();

        $category = $this->informationCategoriesService->getById($request->category_id);

        $values['style'] = $category['style'];

        return view('managements.informations.editConfirm', compact(
            'values',
            'category'
        ));
    }

    /**
     * お知らせ編集.
     *
     * @param Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function edit(Request $request)
    {
        $values = $this->informationsService->getById($request->id);

        $categories = $this->informationCategoriesService->getAll();

        return view('managements.informations.edit', compact(
            'values',
            'categories'
        ));
    }

    /**
     * お知らせ作成処理.
     *
     * @param App\Http\Requests\ManagementsInformationsRequest
     * @return void
     */
    public function post(ManagementsInformationsRequest $request)
    {
        $validated = $request->validated();

        \DB::transaction(function() use($validated) {
            $this->informationsService->insertInformations($validated);
        });

        return redirect()->route('managementsInformations');
    }

    /**
     * お知らせ更新処理.
     *
     * @param App\Http\Requests\ManagementsInformationsRequest
     * @return void
     */
    public function put(ManagementsInformationsRequest $request)
    {
        $validated = $request->validated();

        \DB::transaction(function() use($validated) {
            $this->informationsService->updateInformations($validated);
        });

        return redirect()->route('managementsInformations');
    }
}
