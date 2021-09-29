<?php
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class PasswordResets extends Eloquent\Model
{
    use Notifiable;

    protected $table = 'password_resets';

    public $timestamps = false;

    public $incrementing = false;

    /**
     * Issue a token and insert a new record.
     *
     * @param App\Models\Users
     * @return string
     */
    public function issue($user)
    {
        self::deleteByEmail($user->email);

        $token = Str::random(32);

        $this->forceFill([
            'email' => $user->email,
            'token' => $token,
            'created_at' => new Carbon(),
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

        $expire = (new Carbon($this->created_at))->addMinutes(config('auth.passwords.users.expire'));
        if ((new Carbon())->now() > $expire) {
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