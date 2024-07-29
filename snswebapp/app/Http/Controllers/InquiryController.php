<?php

namespace App\Http\Controllers;

use App\Services\InquiryTypesService;
use App\Services\InquiriesService;
use App\Http\Requests\InquiryRequest;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    // サービス変数.
    private $inquiryTypesService;
    private $inquiriesService;

    /**
     * コンストラクタ.
     *
     * @param App\Services\InquiryTypesService
     * @param App\Services\InquiriesService;
     * @return void
     */
    public function __construct(
        InquiryTypesService $inquiryTypesService,
        InquiriesService $inquiriesService
    ) {
        $this->inquiryTypesService = $inquiryTypesService;
        $this->inquiriesService = $inquiriesService;
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

    /**
     * お問い合わせ入力内容登録.
     *
     * @param App\Http\Requests\InquiryRequest
     * @return Illuminate\View\View
     */
    public function send(InquiryRequest $request)
    {

        $this->inquiriesService->insertInquiries($request->validated());

        return redirect()->route('inquiryComplete');
    }

    /**
     * お問い合わせ登録完了画面.
     *
     * @param Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function complete(Request $request)
    {
        return view('inquiry.complete');
    }

}
