<?php
namespace App\Models;

class VisitedUsers extends Model
{
    public $table = 'visited_users';

    public $timestamps = false;

    /**
     * Visit.
     * 
     * @var int users.id
     * @var int users.id
     * @return boolean
     */
    public static function visit($userId, $visitedId)
    {
        $carbon = carbon();
        if (self::query()
            ->where('date', $carbon->format('Y-m-d'))
            ->where('user_id', $userId)
            ->where('visited_id', $visitedId)
            ->get()->count() == 0) {

            return self::insert([
                'date' => $carbon,
                'user_id' => $userId,
                'visited_id' => $visitedId,
                'created_at' => $carbon,
            ]);
        }

        return false;
    }

    /**
     * Get visited users.
     * 
     * @var int users.id
     * @return array
     */
    public static function getVisitedUsers($userId)
    {
        return self::query()
            ->select([
                'visited_users.date',
                'visited_users.visited_id',
                'users.name',
            ])
            ->join('users', 'visited_users.visited_id', '=', 'users.id')
            ->where('visited_users.user_id', $userId)
            ->orderBy('visited_users.created_at', 'desc')
            ->get();
    }
}