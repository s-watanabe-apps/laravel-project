<?php
namespace App\Services;

use App\Models\Messages;

class MessagesService extends Service
{
    public function getUnreadMessages($userId)
    {
        return Messages::query()
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
    public function getByUserIdAndMessageId($userId, $messageId)
    {
        return Messages::query()
            ->where('messages.to_user_id', $userId)
            ->where('messages.message_id', $messageId)->get()->first();
    }

    /**
     * Get messages by userId and messageId
     * 
     * @var int messages.to_user_id
     * @var int messages.message_id
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getByUserId($userId)
    {
        return Messages::query()
            ->where('messages.to_user_id', $userId)
            ->orderBy('messages.created_at', 'desc')->get();
    }

    /**
     * Get messages by fromUserId
     * 
     * @var int messages.to_user_id
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getByFromUserId($userId)
    {
        return Messages::query()
            ->where('from_user_id', $userId)->get();
    }

    /**
     * Get messages by userId and fromUserId
     * 
     * @var int messages.to_user_id
     * @var int messages.from_user_id
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getByUserIdAndFromUserId($userId, $fromUserId)
    {
        return Messages::query()
            ->where('messages.to_user_id', $userId)
            ->where('messages.from_user_id', $fromUserId)
            ->orderBy('messages.created_at', 'desc')->get();
    }

    public function getDisabled($userId)
    {

    }
}
