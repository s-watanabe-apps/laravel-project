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

class UsersController extends ManagementsController
{
    // Instance variables.
    private $mailService;
    private $usersService;
    private $groupsService;

    /**
     * Create a new controller instance.
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
        ], [
            'keyword' => 'string|nullable',
            'group_code' => 'string|nullable',
            'page' => 'integer|nullable',
        ]);
        if ($validator->fails()) {
            abort(404);
        }

        $validated = $validator->validated();

        $page = $validated['page'] ?? 1;
        $users = $this->usersService->all();
        $users = $this->pager($users, 10, $page, '/managements/users/');

        $groups = $this->groupsService->all();

        return view('managements.users.index', compact(
            'users',
            'groups',
            'validated'
        ));
    }

    /**
     * Get create user form.
     * 
     * @param Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function create(Request $request)
    {
        return view('managements.users.editor');
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
