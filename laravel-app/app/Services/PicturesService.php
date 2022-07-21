<?php

namespace App\Services;

use App\Models\Pictures;

class PicturesService
{
    public function getPictures()
    {
        return Pictures::query()->orderBy('pictures.created_at', 'desc')->paginate(Pictures::PAGENATE);
    }

    public function getPictureById($id)
    {
        return Pictures::query()->where('pictures.id', $id)->get()->first();
    }
}
