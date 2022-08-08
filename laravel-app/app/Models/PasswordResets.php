<?php
namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class PasswordResets extends Model
{
    use Notifiable;

    public $table = 'password_resets';

    public $timestamps = false;

    public $incrementing = false;

    /**
     * Issue a token and insert a new record.
     *
     * @param App\Models\Users
     * @param int
     * @return string
     */
    public function issue($user, $expireMinutes)
    {
        self::deleteByEmail($user->email);

        $token = Str::random(32);

        $this->forceFill([
            'email' => $user->email,
            'token' => $token,
            'expire_in' => carbon()->addMinutes($expireMinutes),
            'created_at' => carbon(),
        ])->save();

        return $this->token;
    }

    /**
     * Reset password.
     *
     * @param App\Models\Users
     * @param string
     * @return void
     */
    public function reset($user, $newPassword)
    {
        $user->setPassword($newPassword);
        self::deleteByEmail($user->email);
    }

    /**
     * Determining that the token is correct and overdue.
     *
     * @param string
     * @return bool
     */
    public function isValidToken($token)
    {
        if ($token !== hash('sha256', $this->token)) {
            return false;
        }

        $expire = carbon($this->created_at)->addMinutes(config('auth.passwords.users.expire'));
        if (carbon() > $expire) {
            return false;
        }

        return true;
    }

    /**
     * Delete by Email.
     *
     * @param String $email
     * @return void
     */
    private static function deleteByEmail($email)
    {
        self::query()->where('email', $email)->delete();
    }
}