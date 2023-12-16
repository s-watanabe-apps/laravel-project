<?php
namespace App\Services;

use App\Models\Headers;
use Illuminate\Support\Facades\DB;

class HeadersService extends Service
{
    /**
     * Get base query builder builder.
     * 
     * @return Illuminate\Database\Eloquent\Builder
     */
    private function base()
    {
        return Headers::query()
            ->select([
                'headers.id',
                'headers.file_name',
                'headers.title_color',
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
