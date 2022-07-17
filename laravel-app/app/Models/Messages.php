<?php

namespace App\Models;

class Messages extends Model
{
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

}
