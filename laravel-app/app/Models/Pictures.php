<?php
namespace App\Models;

use App\Models\Images;

class Pictures extends Model
{
    const PAGENATE = 12;

    /**
     * Get base query.
     * 
     * @return Illuminate\Database\Eloquent\Builder
     */
    public static function query()
    {
        return parent::query()->select([
                'pictures.id',
                'pictures.title',
                'pictures.file',
                'pictures.comment',
                \DB::raw('users.id as user_id'),
                'users.name',
                'pictures.created_at',
            ])
            ->whereNull('pictures.deleted_at')
            ->leftJoin('users', 'pictures.user_id', '=', 'users.id');
    }
}
