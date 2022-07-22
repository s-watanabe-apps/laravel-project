<?php
namespace App\Models;

class PictureComments extends Model
{
    public static function getByPictureId($pictureId)
    {
        return self::query()
            ->where('picture_id', $pictureId)
            ->orderBy('created_at')
            ->get();
    }
}
