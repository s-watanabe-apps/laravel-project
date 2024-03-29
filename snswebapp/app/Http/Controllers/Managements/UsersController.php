<?php
namespace App\Http\Controllers\Managements;

use App\Models\Roles;
use App\Services\MailService;
use App\Services\UsersService;
use App\Services\GroupsService;
use App\Http\Requests\ManagementsUsersRequest;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * ユーザー管理コントローラ.
 * 
 * @author s-watanabe-apps
 * @since 2024-01-01
 * @version 1.0.0
 */
class UsersController extends ManagementsController
{
    // サービス変数.
    private $mailService;
    private $usersService;
    private $groupsService;

    /**
     * コンストラクタ.
     *
     * @param App\Services\MailService
     * @param App\Services\UsersService
     * @param App\Service\GroupsService
     * @return void
     */
    public function __construct(
        MailService $mailService,
        UsersService $usersService,
        groupsService $groupsService
    ) {
        $this->mailService = $mailService;
        $this->usersService = $usersService;
        $this->groupsService = $groupsService;
    }

    /**
     * ユーザー一覧取得.
     * 
     * @param Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
        $validator = Validator::make([
            'keyword' => $request->keyword,
            'group_code' => $request->group_code,
            'page' => $request->page,
            'sort' => $request->sort,
        ], [
            'keyword' => 'string|nullable',
            'group_code' => 'string|nullable',
            'page' => 'integer|nullable',
            'sort' => 'integer|nullable|min:-6|max:6',
        ]);
        if ($validator->fails()) {
            abort(404);
        }

        $validated = $validator->validated();

        list ($users, $headers) = $this->usersService->getUsersForManagements($validated['keyword'], $validated['group_code'], $validated['sort']);
        $users = $this->pager($users, 10, $validated['page'], '/managements/users/');

        $groups = $this->groupsService->all();

        return view('managements.users.index', compact(
            'users',
            'groups',
            'validated',
            'headers'
        ));
    }

    /**
     * ユーザー作成フォーム.
     * 
     * @param Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function create(Request $request)
    {
        return view('managements.users.create');
    }

    /**
     * Confirmation of input contents.
     * 
     * @param App\Http\Requests\ManagementsUsersRequest
     * @return \Illuminate\View\View
     */
    public function confirm(ManagementsUsersRequest $request)
    {
        return view('managements.users.viewer', compact('request'));
    }

    /**
     * Register input information.
     * 
     * @param App\Http\Requests\ManagementsUsersRequest
     * @return Illuminate\View\View
     */
    public function register(ManagementsUsersRequest $request)
    {
        \DB::transaction(function() use ($request) {
            $users = $this->usersService->save([
                'role_id' => Roles::MEMBER,
                'email' => $request->email,
                'name' => $request->name,
            ]);

            $this->mailService->sendInvitationMail($users);
        });

        exit;
    }

}
