<?php

namespace App\Http\Controllers\Managements;

use App\Models\Users;
use App\Models\PasswordResets;
use App\Models\Roles;
use App\Http\Requests\ManagementsUsersPostRequest;
use Illuminate\Http\Request;

class UsersController extends ManagementsController
{
    public function index(Request $request)
    {
        $users = Users::getAllUsers();
        
        $dataTablesLanguage = json_encode(__('strings.datatables'), JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);

        return view('managements.users.index', compact(
            'users', 'dataTablesLanguage'
        ));
    }

    public function create(Request $request)
    {
        return view('managements.users.create');
    }

    public function post(ManagementsUsersPostRequest $request)
    {
        var_dump($request->email);
        var_dump($request->name);
        \DB::transaction(function() use ($request) {
            $users = new Users();
            $users->role_id = Roles::MEMBER;
            $users->email = $request->email;
            $users->name = $request->name;
            $users->save();

            (new PasswordResets)->issue($users);
        });
        exit;
    }

}
