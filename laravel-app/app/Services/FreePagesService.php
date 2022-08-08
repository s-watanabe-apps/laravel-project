<?php
namespace App\Services;

use App\Models\FreePages;

class FreePagesService extends Service
{
    /**
     * Get all free pages.
     * 
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return FreePages::all();
    }

    /**
     * Get free pages by id.
     * 
     * @param int
     * @return App\Models\FreePages
     */
    public function find($id)
    {
        return FreePages::find($id);
    }

    /**
     * Add as an array.
     * 
     * @param array
     * @return App\Models\FreePages
     */
    public function add($values) {
        $freePages = new FreePages();
        $freePages->fill($values)->save();
        return $freePages;
    }

    /**
     * Get free page by code.
     * 
     * @param string
     * @return App\Models\FreePages
     */
    public function getByCode($code)
    {
        return FreePages::query()->where(['code' => $code,])->first();
    }

}
