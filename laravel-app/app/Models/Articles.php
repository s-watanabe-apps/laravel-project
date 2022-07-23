<?php
namespace App\Models;

use App\Models\Images;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Articles extends Model
{
    use SoftDeletes;

    // Model constants.
    const TYPE_MEMBER_ARTICLE = 1;

    // Multiple assignable attributes.
    protected $fillable = [
        'user_id',
        'type',
        'status',
        'title',
        'body',
    ];

    /**
     * Get base query.
     * 
     * @return Illuminate\Database\Eloquent\Builder
     */
    public static function query()
    {
        return parent::query()
            ->select([
                'articles.id',
                'articles.user_id',
                'users.name',
                'articles.type',
                'articles.status',
                'articles.title',
                'articles.body',
                'articles.created_at',
                'articles.updated_at',
                'articles.deleted_at',
            ])
            ->leftJoin('users', function ($join) {
                $join->on('users.id', '=', 'articles.user_id')
                    ->whereNull('users.deleted_at');
            });
    }
}
