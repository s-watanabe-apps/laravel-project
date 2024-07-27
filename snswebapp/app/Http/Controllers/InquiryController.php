<?php

namespace App\Http\Controllers;

use App\Services\InquiryTypesService;
use App\Http\Requests\InquiryRequest;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    // サービス変数.
    private $inquiryTypesService;

    /**
     * コンストラクタ.
     *
     * @param App\Services\InquiryTypesService
     * @return void
     */
    public function __construct(
        InquiryTypesService $inquiryTypesService
    ) {
        $this->inquiryTypesService = $inquiryTypesService;
    }

    /**
     * お問い合わせ登録画面.
     *
     * @param Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
        $types = array_column($this->inquiryTypesService->getInquiryTypes(), 'name', 'id');

        return view('inquiry.index', compact('types'));
    }

    /**
     * お問い合わせ入力内容確認画面.
     *
     * @param App\Http\Requests\InquiryRequest
     * @return Illuminate\View\View
     */
    public function confirm(InquiryRequest $request)
    {
        $types = array_column($this->inquiryTypesService->getInquiryTypes(), 'name', 'id');

        $validated = $request->validated();

        return view('inquiry.confirm', compact('types', 'validated'));
    }

}
