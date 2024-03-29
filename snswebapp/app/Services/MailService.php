<?php
namespace App\Services;

use App\Mail\ContactMail;
use App\Models\PasswordResets;
use App\Services\SettingsService;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;

class MailService extends Service
{
    /**
     * メール送信.
     * 
     * @param string
     * @param App\Mail\ContactMail
     * @return void
     */
    private function sendMail($to, $contactMail)
    {
        Mail::to($to)->send($contactMail);
    }

    /**
     * 招待メール送信.
     * 
     * @param App\Models\Users
     * @return void
     */
    public function sendInvitationMail($users)
    {
        $settings = (new SettingsService())->get();

        $expireInHours = env('PASSWORD_RESET_EXPIRE_IN_HOURW', 24);
        $token = (new PasswordResets())->issue($users, 60 * $expireInHours);
        $encryptToken = Crypt::encryptString($users->email . ',' . $token);

        $data = [
            'name' => $users->name,
            'token' => $encryptToken,
            'expire_in' => $expireInHours . __('strings.expire_in_hours'),
        ];

        $subject = sprintf("[%s] %s", $settings->site_name, __('strings.invitation'));
        $template = implode('.', ['emails', \App::getLocale(), 'user_invitation']);

        $this->sendMail($users->email, new ContactMail($subject, $template, $data));
    }
}
