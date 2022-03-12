<?php
namespace App\Http\Controllers\Auth;

use App\Models\Users;
use App\Models\PasswordResets;
use App\Http\Controllers\Controller;
use App\Http\Requests\ForgetPasswordSendResetMailRequest;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;


class ForgotPasswordController extends Controller
{
    /**
     * Reset password.
     * 
     * @var Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('forgotPassword');
    }

    /**
     * Send a password reset email.
     * 
     * @var App\Request\ForgetPasswordSendResetMailRequest
     * @return \Illuminate\View\View
     */
    public function sendResetMail(ForgetPasswordSendResetMailRequest $request)
    {
        $user = Users::getByEmail($request->email);
        if ($user != null) {
            $token = (new PasswordResets())->issue($user, 30);

            $encryptToken = Crypt::encryptString($request->email . ',' . $token);

            $data = [
                'name' => $user->name,
                'token' => $encryptToken,
            ];

            $subject = sprintf("[%s] %s", $request->settings->site_name, __('strings.reset_password'));
            $template = implode('.', ['emails', \App::getLocale(), 'reset_password']);

            Mail::to($request->email)->send(new ContactMail($subject, $template, $data));
        }

        $resultMessage = str_replace(':email', $request->email, __('auth.send_reset_mail_result_message'));

        return view('forgotPassword', compact('resultMessage'));
    }
}
