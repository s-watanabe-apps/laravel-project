<?php
namespace App\Http\Controllers\Managements;

use App\Http\Requests\ManagementsInquiryTypesRequest;
use App\Services\InquiryTypesService;
use Illuminate\Http\Request;

class InquiryTypesController extends ManagementsController
{
    // サービス変数.
    private $inquiryTypesService;

    /**
     * コンストラクタ.
     *
     * @param App\Services\GroupsService
     * @return void
     */
    public function __construct(
        InquiryTypesService $inquiryTypesService
    ) {
        $this->inquiryTypesService = $inquiryTypesService;
    }

    /**
     * お問い合わせ種別管理画面.
     *
     * @param Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
        $types = $this->inquiryTypesService->getInquiryTypes();

        return view('managements.inquirytypes.index', compact('types'));
    }

    /**
     * お問い合わせ種別保存.
     *
     * @param Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function save(ManagementsInquiryTypesRequest $request)
    {
        $types = $this->inquiryTypesService->getInquiryTypes();

        \DB::transaction(function() use ($request) {
            $this->inquiryTypesService->save($request->validated());
        });

        return redirect()->route('managementsInquiryTypes');
    }
}
