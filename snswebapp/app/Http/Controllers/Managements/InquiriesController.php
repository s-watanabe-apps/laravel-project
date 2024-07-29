<?php
namespace App\Http\Controllers\Managements;

use App\Services\InquiriesService;
use App\Services\InquiryTypesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InquiriesController extends ManagementsController
{
    // サービス変数.
    private $inquiriesService;
    private $inquiryTypesService;

    /**
     * コンストラクタ.
     *
     * @param App\Services\InquiriesService
     * @return void
     */
    public function __construct(
        InquiriesService $inquiriesService,
        InquiryTypesService $inquiryTypesService
    ) {
        $this->inquiriesService = $inquiriesService;
        $this->inquiryTypesService = $inquiryTypesService;
    }

    /**
     * お問い合わせ一覧画面.
     *
     * @param Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
        $validator = Validator::make([
            'keyword' => $request->keyword,
            'type' => $request->type,
            'page' => $request->page,
            'sort' => $request->sort,
        ], [
            'keyword' => 'string|nullable',
            'type' => 'integer|nullable',
            'page' => 'integer|nullable',
            'sort' => 'integer|nullable|min:-6|max:6',
        ]);
        if ($validator->fails()) {
            abort(404);
        }

        $validated = $validator->validated();

        list ($inquiries, $headers) = $this->inquiriesService->getInquiries(
            $validated['keyword'], $validated['type'], $validated['sort']);
        $inquiries = $this->pager($inquiries, 10, $validated['page'], '/managements/inquiries/');

        $types = $this->inquiryTypesService->getInquiryTypes();

        return view('managements.inquiries.index', compact('inquiries', 'types', 'validated', 'headers'));
    }
}
