<?php

namespace App\Models;

use Carbon\Carbon;

class VisitedUsers extends Model
{
    protected $table = 'visited_users';

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
        $carbon = new Carbon();
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