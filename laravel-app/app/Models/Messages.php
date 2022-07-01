<?php

namespace App\Models;

class Messages extends Model
{
    protected $table = 'messages';

    /**
     * Base query of messages.
     */
    public static function query()
    {
        return parent::query()->select([
                'messages.id',
                'messages.subject',
                'messages.body',
                'messages.readed',
                'messages.enable',
                'messages.from_user_id',
                'messages.message_id',
                'users.name',
                'users.image_file',
                'messages.created_at',
            ])->leftJoin('users', function ($join) {
                $join->on('messages.from_user_id', '=', 'users.id')
                    ->where('users.enable', 1);
            })->whereNull('messages.deleted_at');
    }

    public static function getUnreadMessages($userId)
    {
        return self::query()
            ->where('messages.to_user_id', $userId)
            ->where('messages.readed', 0)
            ->orderBy('messages.created_at', 'desc')
            ->limit(5)
            ->get();
    }

    /**
     * Get messages by userId
     * 
     * @var int messages.to_user_id
     * @var int messages.message_id
     * @return App\Models\Messages
     */
    public static function getByUserIdAndMessageId($userId, $messageId)
    {
        return self::query()
            ->where('messages.to_user_id', $userId)
            ->where('messages.message_id', $messageId)->get()->first();
    }

    /**
     * Get messages by userId and messageId
     * 
     * @var int messages.to_user_id
     * @var int messages.message_id
     * @return [App\Models\Messages]
     */
    public static function getByUserId($userId)
    {
        return self::query()
            ->where('messages.to_user_id', $userId)
            ->orderBy('messages.created_at', 'desc')->get();
    }

    /**
     * Get messages by fromUserId
     * 
     * @var int messages.to_user_id
     * @return array[App\Models\Messages]
     */
    public static function getByFromUserId($userId)
    {
        return self::query()
            ->where('from_user_id', $userId)->get();
    }

    /**
     * Get messages by userId and fromUserId
     * 
     * @var int messages.to_user_id
     * @var int messages.from_user_id
     * @return array[App\Models\Massages]
     */
    public static function getByUserIdAndFromUserId($userId, $fromUserId)
    {
        return self::query()
            ->where('messages.to_user_id', $userId)
            ->where('messages.from_user_id', $fromUserId)
            ->orderBy('messages.created_at', 'desc')->get();
    }

    public static function getDisabled($userId)
    {

    }
}
