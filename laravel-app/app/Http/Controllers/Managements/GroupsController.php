<?php
namespace App\Http\Controllers\Managements;

use App\Models\Roles;
use App\Services\MailService;
use App\Services\UsersService;
use App\Http\Requests\ManagementsUsersRequest;
use App\Mail\ContactMail;
use Illuminate\Http\Request;

class GroupsController extends ManagementsController
{
    // Instance variables.
    //private $usersService;

    /**
     * Create a new controller instance.
     *
     * @param App\Services\MailService
     * @param App\Services\UsersService
     * @return void
     */
    public function __construct(
        //MailService $mailService,
        //UsersService $usersService
    ) {
        //$this->mailService = $mailService;
        //$this->usersService = $usersService;
    }

    /**
     * Get group List.
     * 
     * @param Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
        echo 1;
        exit;
        //$users = $this->usersService->getAllUsers();

        //return view('managements.users.index', compact(
        //    'users'
        //));
    }
}
