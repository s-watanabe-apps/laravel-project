<?php
namespace App\Services;

use App\Models\LoginImages;
use Illuminate\Support\Facades\DB;

class LoginImagesService extends Service
{
    /**
     * 基本クエリ.
     * 
     * @return Illuminate\Database\Eloquent\Builder
     */
    private function base()
    {
        return LoginImages::query()
            ->select([
                'login_images.*',
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
