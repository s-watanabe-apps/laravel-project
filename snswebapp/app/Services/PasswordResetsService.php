<?php
namespace App\Services;

use App\Models\PasswordResets;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Str;

class PasswordResetsService extends Service
{
    /**
     * 基本クエリ.
     * 
     * @return Illuminate\Database\Eloquent\Builder
     */
    private function base()
    {
        return PasswordResets::query()
            ->select([
                'password_resets.*',
            ]);
    }

    /**
     * パスワードリセット登録.
     *
     * @param App\Models\Users $user
     * @param int $expireInMinutes
     * @return string
     */
    public function issue($user, $expireInMinutes)
    {
        PasswordResets::query()
            ->where('email', $user->email)
            ->delete();

        $expireInMinutes = 30;
        $token = Str::random(32);

        (new PasswordResets())->forceFill([
            'email' => $user->email,
            'token' => $token,
            'expire_in' => carbon()->addMinutes($expireInMinutes),
            'created_at' => carbon(),
        ])->save();

        return $token;
    }

    /**
     * パスワードリセットメール送信.
     * 
     * @param string $email
     * @return void
     */
    public function sendResetMail(string $email)
    {
        $user = (new UsersService())->getByEmail($email);

        if ($user != null) {
            $expireInMinutes = 30;
            $token = $this->issue($user, $expireInMinutes);
            
            $encryptToken = Crypt::encryptString($email . ',' . $token);
            
            $data = [
                'name' => $user->name,
                'token' => $encryptToken,
                'expire_in' => $expireInMinutes . __('strings.expire_in_minutes'),
            ];

            $subject = sprintf("[%s] %s", settings()['site_name'], __('strings.reset_password'));
            $template = implode('.', ['emails', \App::getLocale(), 'reset_password']);

            Mail::to($email)->send(new ContactMail($subject, $template, $data));
        } else {
            sleep(2);
        }
    }

    /**
     * パスワードリセット.
     * 
     * @param string $password
     * @param string $token
     * @return void
     */
    public function resetPassword(string $password, string $token)
    {
        try {
            list($email, $key) = explode(',', Crypt::decryptString($token));

            $passwordResets = PasswordResets::where([
                'email' => $email,
                'token' => $key,
            ])->first();

            if (is_null($passwordResets)) {
                // TODO
                dump($passwordResets);
                exit;
            }

            if (carbon()->gt(carbon($passwordResets->expire_in))) {
                // TODO
                dump(carbon()->gt(carbon($passwordResets->expire_in)));
                exit;
            }

            UsersService::updatePasswordByEmail($email, $password);

            $passwordResets->delete();

        } catch (DecryptException $e) {
            // TODO
            dump($e->getMessage());
            exit;
        }
    }


}
