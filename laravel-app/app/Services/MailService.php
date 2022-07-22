<?php
namespace App\Services;

use App\Mail\ContactMail;
use App\Models\PasswordResets;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;

class MailService
{
    /**
     * Send mail.
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
     * Send invitation mail.
     * 
     * @param App\Models\Users
     * @return void
     */
    public function sendInvitationMail($users)
    {
        $expireInHours = 24;
        $token = (new PasswordResets)->issue($users, 60 * $expireInHours);
        $encryptToken = Crypt::encryptString($users->email . ',' . $token);

        $data = [
            'name' => $users->name,
            'token' => $encryptToken,
            'expire_in' => $expireInHours . __('strings.expire_in_hours'),
        ];

        $subject = sprintf("[%s] %s", 'TODO:site_name', __('strings.invitation'));
        $template = implode('.', ['emails', \App::getLocale(), 'user_invitation']);

        $this->sendMail($users->email, new ContactMail($subject, $template, $data));
    }
}
