<?php
namespace App\Http\Controllers\Managements;

use App\Models\FreePages;
use App\Services\FreePagesService;
use App\Http\Requests\ManagementsFreePagesRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class FreePagesController extends ManagementsController
{
    // Instance variables.
    private $freePagesService;

    /**
     * コンストラクタ.
     *
     * @param App\Services\FreePagesService
     * @return void
     */
    public function __construct(FreePagesService $freePagesService)
    {
        $this->freePagesService = $freePagesService;
    }

    /**
     * フリーページリスト.
     *
     * @param Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
        $validator = Validator::make([
            'keyword' => $request->keyword,
            'status' => $request->status,
            'page' => $request->page,
            'sort' => $request->sort,
        ], [
            'keyword' => 'string|nullable',
            'status' => 'integer|nullable|in:0,1',
            'page' => 'integer|nullable',
            'sort' => 'integer|nullable',
        ]);
        if ($validator->fails()) {
            abort(404);
        }

        $validated = $validator->validated();

        $page = $validated['page'] ?? 1;
        list($freePages, $headers) = $this->freePagesService->getFreepages(
            $validated['keyword'], $validated['status'], $validated['sort']);
        $freePages = $this->pager($freePages, 10, $page, '/managements/freepages/');

        return view('managements.freepages.index', compact(
            'freePages',
            'headers',
            'validated'
        ));
    }

    /**
     * フリーページ確認画面.
     *
     * @param Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function get(Request $request)
    {
        $freePages = $this->freePagesService->get($request->id);

        return view('managements.freepages.view', compact('freePages'));
    }

    /**
     * フリーページ新規作成画面.
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
     * フリーページ新規作成確認画面.
     *
     * @param App\Http\Requests\ManagementsFreepagesRequest
     * @return Illuminate\View\View
     */
    public function createConfirm(ManagementsFreepagesRequest $request)
    {
        dump($request->validated());
        exit;

        return view('managements.freepages.confirm', compact('freePages'));
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
            $this->freePagesService->save($request);
        });

        return redirect()->route('managementsFreepages');
    }
}
