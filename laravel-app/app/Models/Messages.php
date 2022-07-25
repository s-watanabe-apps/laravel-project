<?php
namespace App\Models;

use App\Libs\Status;

class Messages extends Model
{
    protected $table = 'messages';

    /**
     * Get base query.
     * 
     * @return Illuminate\Database\Eloquent\Builder
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
                    ->where('users.status', Status::ENABLED);
            })->whereNull('messages.deleted_at');
    }

}
