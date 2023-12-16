<?php
namespace App\Services;

use App\Models\HeaderImages;
use Illuminate\Support\Facades\DB;

class HeaderImagesService extends Service
{
    /**
     * Get base query builder builder.
     * 
     * @return Illuminate\Database\Eloquent\Builder
     */
    private function base()
    {
        return HeaderImages::query()
            ->select([
                'header_images.id',
                'header_images.file_name',
                'header_images.title_color',
            ]);
    }

    /**
     * Get headers.
     */
    public function get()
    {
        return $this->base()->get();
    }
}
