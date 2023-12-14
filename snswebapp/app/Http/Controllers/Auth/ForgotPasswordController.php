<?php
namespace App\Http\Controllers\Auth;

use App\Models\PasswordResets;
use App\Services\UsersService;
use App\Services\PasswordResetsService;
use App\Http\Controllers\Controller;
use App\Http\Requests\ForgetPasswordSendResetMailRequest;
use App\Http\Requests\ResetPasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;

class ForgotPasswordController extends Controller
{
    private $usersService;
    private $passwordResetsService;

    /**
     * Create a new controller instance.
     *
     * @param App\Services\UsersService
     * @return void
     */
    public function __construct(
        UsersService $usersService,
        PasswordResetsService $passwordResetsService
    ) {
        $this->usersService = $usersService;
        $this->passwordResetsService = $passwordResetsService;
    }

    /**
     * View for sending password reset email.
     * 
     * @var Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('auth.passwords.forgot');
    }

    /**
     * Send a password reset email.
     * 
     * @var App\Request\ForgetPasswordSendResetMailRequest
     * @return \Illuminate\View\View
     */
    public function sendResetMail(ForgetPasswordSendResetMailRequest $request)
    {
        \DB::transaction(function() use ($request) {
            $this->usersService->sendResetMail($request->email);
        });

        return view('auth.passwords.forgot', [
            'result_message' => sprintf(__('auth.send_reset_mail_result_message'), $request->email),
        ]);
    }

    /**
     * View to reset password.
     * 
     * @var Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function reset(Request $request)
    {
        $validator = Validator::make([
            'token' => $request->token,
        ], [
            'token' => 'string|max:288',
        ]);

        return view('auth.passwords.reset', [
            'token' => $validator->validated()['token'],
        ]);
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        dump($request->validated());
        exit;
    }
}
