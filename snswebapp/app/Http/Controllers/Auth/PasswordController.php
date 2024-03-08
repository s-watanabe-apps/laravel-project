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

class PasswordController extends Controller
{
    private $usersService;
    private $passwordResetsService;

    /**
     * コンストラクタ.
     *
     * @param App\Services\UsersService
     * @param App\Services\PasswordResetsService
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
     * パスワードリセットメール送信画面.
     * 
     * @var Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function email(Request $request)
    {
        return view('auth.password.email');
    }

    /**
     * パスワードリセットメール送信.
     * 
     * @var App\Request\ForgetPasswordSendResetMailRequest
     * @return \Illuminate\View\View
     */
    public function sendResetMail(ForgetPasswordSendResetMailRequest $request)
    {
        \DB::transaction(function() use ($request) {
            $this->passwordResetsService->sendResetMail($request->email);
        });

        return view('auth.password.email', [
            'result_message' => sprintf(__('auth.send_reset_mail_result_message'), $request->email),
        ]);
    }

    /**
     * パスワードリセット画面.
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

        $validated = $validator->validated();

        return view('auth.password.reset', $validated);
    }

    /**
     * パスワードリセット.
     * 
     * @param ResetPasswordRequest $request
     * @return \Illuminate\View\View
     */
    public function resetPassword(ResetPasswordRequest $request)
    {
        \DB::transaction(function() use ($request) {
            $this->passwordResetsService->resetPassword($request->password, $request->token);
        });
exit;
        return view('auth.password.reset', [
            'result_message' => 'OK',
        ]);
    }
}
