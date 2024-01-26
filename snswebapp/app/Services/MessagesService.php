<?php
namespace App\Services;

use App\Models\Messages;

class MessagesService extends Service
{
    /**
     * Get base query builder.
     * 
     * @return Illuminate\Database\Eloquent\Builder
     */
    private function base()
    {
        return Messages::query()
            ->select([
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
                    ->where('users.status', \Status::ENABLED);
            })->whereNull('messages.deleted_at');
    }

    /**
     * Get unread messages.
     * 
     * @param int $user_id
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function get_unread_messages($user_id)
    {
        return $this->base()
            ->where('messages.to_user_id', $user_id)
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
        return $this->base()
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
        return $this->base()
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
        return $this->base()
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
        return $this->base()
            ->where('messages.to_user_id', $userId)
            ->where('messages.from_user_id', $fromUserId)
            ->orderBy('messages.created_at', 'desc')->get();
    }

    public function getDisabled($userId)
    {

    }
}
