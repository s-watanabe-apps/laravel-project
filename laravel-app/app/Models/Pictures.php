<?php

namespace App\Models;

use App\Models\Images;
use Illuminate\Database\Eloquent\Model;

class Pictures extends Model
{
    const PAGENATE = 12;

    protected $table = 'pictures';

    public static function getPictureImages($id = null)
    {
        $results = self::query()->select([
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
        
        if (!is_null($id)) {
            return $results->where('pictures.id', $id)
                ->get()->first();
        }

        return $results->orderBy('pictures.created_at', 'desc')
            ->paginate(self::PAGENATE);
    }
}
