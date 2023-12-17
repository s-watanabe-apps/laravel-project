<?php
namespace App\Services;

use App\Models\LoginImages;
use Illuminate\Support\Facades\DB;

class LoginImagesService extends Service
{
    /**
     * Get base query builder builder.
     * 
     * @return Illuminate\Database\Eloquent\Builder
     */
    private function base()
    {
        return LoginImages::query()
            ->select([
                'login_images.id',
                'login_images.file_name',
            ]);
    }

    /**
     * Get login images.
     */
    public function get()
    {
        return $this->base()->get();
    }
}
