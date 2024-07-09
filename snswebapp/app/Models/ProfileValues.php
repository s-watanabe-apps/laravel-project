<?php
namespace App\Models;

class ProfileValues extends Model
{
    protected $table = 'profile_values';
    protected $primaryKey = ['user_id', 'profile_id'];
    protected $fillable = ['user_id', 'profile_id'];
    public $incrementing = false;
    public $timestamps = false;

    /**
     * プロフィールカスタム設定項目取得.
     *
     * @var int $user_id
     * @return array
     */
    public static function get_profile_values_hash_by_user_id($user_id) {
        $profile_values = self::query()->where('user_id', $user_id)->get();

        $results = [];
        foreach ($profile_values as $value) {
            $results[$value->profile_id] = $value;
        }

        return $results;
    }

    /**
     * プロフィールカスタム設定項目保存.
     *
     * @var int $user_id
     * @var array $values
     * @return void
     */
    public static function save_profile_values($user_id, $values)
    {
        $profile_values = self::get_profile_values_hash_by_user_id($user_id);

        foreach ($values as $key => $value) {
            if (array_key_exists($key, $profile_values)) {
                if (strcmp($profile_values[$key]->value, $value) != 0) {
                    self::where('user_id', $user_id)
                        ->where('profile_id', $key)
                        ->update(['value' => $value]);
                }
            } else {
                self::insert([
                    'user_id' => $user_id,
                    'profile_id' => $key,
                    'value' => $value,
                ]);
            }
        }

    }
}
