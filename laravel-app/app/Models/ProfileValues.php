<?php
namespace App\Models;

class ProfileValues extends Model
{
    // Table name.
    public $table = 'profile_values';

    // Primary key.
    protected $primaryKey = ['user_id', 'profile_id'];

    protected $fillable = ['user_id', 'profile_id'];
    
    public $incrementing = false;
    
    // Timestamps.
    public $timestamps = false;

    /**
     * Get the value with HashMap.
     * 
     * @var int users.id
     * @return array [profile_values.id => App\Models\ProfileValue]
     */
    public static function getProfileValuesHashByUserId($userId) {
        $profileValues = self::query()->where('user_id', $userId)->get();

        $results = [];
        foreach ($profileValues as $profileValue) {
            $results[$profileValue->profile_id] = $profileValue;
        }

        return $results;
    }

    /**
     * Save profile values.
     * 
     * @var int users.id
     * @var array inputValues
     * @return void
     */
    public static function saveProfileValues($userId, $inputValues)
    {
        $profileValues = self::getProfileValuesHashByUserId($userId);

        foreach ($inputValues as $key => $value) {
            if (array_key_exists($key, $profileValues)) {
                if (strcmp($profileValues[$key]->value, $value) != 0) {
                    self::where('user_id', $userId)
                        ->where('profile_id', $key)
                        ->update(['value' => $value]);
                }
            } else {
                self::insert([
                    'user_id' => $userId,
                    'profile_id' => $key,
                    'value' => $value,
                ]);
            }
        }

    }
}
