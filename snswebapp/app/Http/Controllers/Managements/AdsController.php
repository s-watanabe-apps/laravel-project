<?php
namespace App\Http\Controllers\Managements;

//use App\Models\FreePages;
use App\Services\AdsService;
//use App\Http\Requests\UploadFileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

/**
 * 広告管理コントローラ.
 *
 * @author s-watanabe-apps
 * @since 2024-01-01
 * @version 1.0.0
 */
class AdsController extends ManagementsController
{
    //AdsService $adsService;

    /**
     * コンストラクタ.
     *
     * @param App\Services\AdsService
     * @return void
     */
    public function __construct(
        AdsService $adsService
    ) {
        $this->adsService = $adsService;
    }

    /**
     * 広告一覧.
     *
     * @param Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('managements.ads.index');
    }

    /**
     * 広告保存.
     *
     * @param App\Http\Requests\UploadFileRequest
     */
    public function save(Request $request)
    {
        return redirect()->route('managementsAds');
    }
}
