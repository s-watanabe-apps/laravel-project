<?php
namespace App\Services;

use App\Models\HeaderImages;
use Illuminate\Support\Facades\DB;

class HeaderImagesService extends Service
{
    /**
     * 基本クエリ.
     * 
     * @return Illuminate\Database\Eloquent\Builder
     */
    private function base()
    {
        return HeaderImages::query()
            ->select([
                'header_images.*',
            ]);
    }

    /**
     * Get header images.
     */
    public function get()
    {
        return $this->base()->get();
    }
}
