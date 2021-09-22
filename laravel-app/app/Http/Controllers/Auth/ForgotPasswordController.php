<?php
namespace App\Http\Controllers\Auth;

use App\Models\Users;
use App\Models\PasswordResets;
use App\Http\Controllers\Controller;
use App\Http\Requests\ForgetPasswordSendResetMailRequest;
use Illuminate\Http\Request;

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
        $inputValues = $request->validated();
        $user = Users::getByEmail($inputValues['email']);
        if ($user != null) {
            $token = (new PasswordResets())->issue($user);
            var_dump($token);
        }

        $resultMessage = str_replace(':email', $inputValues['email'], __('auth.send_reset_mail_result_message'));

        return view('forgotPassword', compact('resultMessage'));
    }
}
