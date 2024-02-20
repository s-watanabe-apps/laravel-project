<?php
namespace App\Services;

use App\Models\Messages;

class MessagesService extends Service
{
    /**
     * 基本クエリ.
     * 
     * @return Illuminate\Database\Eloquent\Builder
     */
    private function base()
    {
        return Messages::query()
            ->select([
                'messages.*',
                'users.name',
                'users.image_file',
            ])->leftJoin('users', function ($join) {
                $join->on('messages.from_user_id', '=', 'users.id')
                    ->where('users.status', \Status::ENABLED);
            })->whereNull('messages.deleted_at');
    }

    /**
     * 未読メッセージ取得.
     * 
     * @param int $userId
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getUnreadMessages($userId, $limit = 5)
    {
        return $this->base()
            ->where('messages.to_user_id', $userId)
            ->where('messages.readed', 0)
            ->orderBy('messages.created_at', 'desc')
            ->limit($limit)
            ->get()
            ->toArray();
    }

    /**
     * ユーザーの受信メッセージ取得.
     * 
     * @param int $userId
     * @param int $messageId
     * 
     * @return array
     */
    public function getByUserIdAndMessageId($userId, $messageId)
    {
        return $this->base()
            ->where('messages.to_user_id', $userId)
            ->where('messages.message_id', $messageId)
            ->first()
            ->toArray();
    }

    /**
     * ユーザーの受信メッセージ全件取得.
     * 
     * @param int $userId
     * 
     * @return array
     */
    public function getByUserId($userId)
    {
        return $this->base()
            ->where('messages.to_user_id', $userId)
            ->orderBy('messages.created_at', 'desc')
            ->get()
            ->toArray();
    }

    /**
     * ユーザー(自分)の送信メッセージ全件取得.
     * 
     * @var int $fromUserId
     * 
     * @return array
     */
    public function getByFromUserId($fromUserId)
    {
        return $this->base()
            ->where('from_user_id', $fromUserId)
            ->get()
            ->toArray();
    }

    /**
     * 特定ユーザーからの受信メッセージ全件取得.
     * 
     * @var int $userId
     * @var int $fromUserId
     * 
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getByUserIdAndFromUserId($userId, $fromUserId)
    {
        return $this->base()
            ->where('messages.to_user_id', $userId)
            ->where('messages.from_user_id', $fromUserId)
            ->orderBy('messages.created_at', 'desc')
            ->get()
            ->toArray();
    }

    public function getDisabled($userId)
    {

    }
}
