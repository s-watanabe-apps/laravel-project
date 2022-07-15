<?php

namespace App\Http\Controllers\Managements;

use App\Models\Users;
use App\Models\PasswordResets;
use App\Models\Roles;
use App\Http\Requests\ManagementsUsersPostRequest;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;

class UsersController extends ManagementsController
{
    /**
     * Get user List.
     * 
     * @param Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
        $users = Users::getAllUsers();

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
     * @param App\Http\Requests\ManagementsUsersPostRequest
     * @return \Illuminate\View\View
     */
    public function confirm(ManagementsUsersPostRequest $request)
    {
        return view('managements.users.viewer', compact('request'));
    }

    /**
     * Register input information.
     * 
     * @param App\Http\Requests\ManagementsUsersPostRequest
     * @return Illuminate\View\View
     */
    public function register(ManagementsUsersPostRequest $request)
    {
        \DB::transaction(function() use ($request) {
            $users = new Users();
            $users->role_id = Roles::MEMBER;
            $users->email = $request->email;
            $users->name = $request->name;
            $users->save();

            $expire_in_hours = 24;
            $token = (new PasswordResets)->issue($users, 60 * $expire_in_hours);
            $encryptToken = Crypt::encryptString($request->email . ',' . $token);

            $data = [
                'name' => $request->name,
                'token' => $encryptToken,
                'expire_in' => $expire_in_hours . __('strings.expire_in_hours'),
            ];

            $subject = sprintf("[%s] %s", $request->settings->site_name, __('strings.invitation'));
            $template = implode('.', ['emails', \App::getLocale(), 'user_invitation']);

            Mail::to($request->email)->send(new ContactMail($subject, $template, $data));
    
        });

        exit;
    }

}
