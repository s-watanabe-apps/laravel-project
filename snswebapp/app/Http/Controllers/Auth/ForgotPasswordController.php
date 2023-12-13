<?php
namespace App\Http\Controllers\Auth;

use App\Models\PasswordResets;
use App\Services\UsersService;
use App\Services\PasswordResetsService;
use App\Http\Controllers\Controller;
use App\Http\Requests\ForgetPasswordSendResetMailRequest;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;


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
     * Reset password.
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
        $user = $this->usersService->getByEmail($request->email);
        if ($user != null) {
            $expire_in_minutes = 30;
            $token = (new PasswordResets())->issue($user, $expire_in_minutes);

            $encryptToken = Crypt::encryptString($request->email . ',' . $token);

            $data = [
                'name' => $user->name,
                'token' => $encryptToken,
                'expire_in' => $expire_in_minutes . __('strings.expire_in_minutes'),
            ];

            $subject = sprintf("[%s] %s", $request->settings->site_name, __('strings.reset_password'));
            $template = implode('.', ['emails', \App::getLocale(), 'reset_password']);

            Mail::to($request->email)->send(new ContactMail($subject, $template, $data));
        }

        $resultMessage = str_replace(':email', $request->email, __('auth.send_reset_mail_result_message'));

        return view('auth.passwords.forgot', compact('resultMessage'));
    }

    /**
     * Reset password.
     * 
     * @var Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function reset(Request $request)
    {
        $token = 'hogehoge';

        return view('auth.passwords.reset', compact('token'));
    }
}
