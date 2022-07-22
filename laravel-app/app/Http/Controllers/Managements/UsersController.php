<?php
namespace App\Http\Controllers\Managements;

use App\Models\Roles;
use App\Services\MailService;
use App\Services\UsersService;
use App\Http\Requests\ManagementsUsersRequest;
use App\Mail\ContactMail;
use Illuminate\Http\Request;

class UsersController extends ManagementsController
{
    // Instance variables.
    private $usersService;

    /**
     * Create a new controller instance.
     *
     * @param App\Services\MailService
     * @param App\Services\UsersService
     * @return void
     */
    public function __construct(
        MailService $mailService,
        UsersService $usersService
    ) {
        $this->mailService = $mailService;
        $this->usersService = $usersService;
    }

    /**
     * Get user List.
     * 
     * @param Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
        $users = $this->usersService->getAllUsers();

        return view('managements.users.index', compact(
            'users'
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
