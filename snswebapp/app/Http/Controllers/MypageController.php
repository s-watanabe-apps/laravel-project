<?php
namespace App\Http\Controllers;

use App\Services\UsersService;
use Illuminate\Http\Request;

/**
 * マイページコントローラ.
 * 
 * @author s-watanabe-apps
 * @since 2024-01-01
 * @version 1.0.0
 */
class MypageController extends Controller
{
    private $usersService;

    /**
     * コンストラクタ.
     *
     * @param App\Services\UsersService
     * @return void
     */
    public function __construct(
        UsersService $usersService
    ) {
        $this->usersService = $usersService;
    }
    
    /**
     * マイページ.
     * 
     * @param Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
        //dump(request()->ip());
        //dump($request->headers->get('user-agent'));
        $user = user();

        return view('mypage.index', compact(
            'user'
        ));
    }
}
