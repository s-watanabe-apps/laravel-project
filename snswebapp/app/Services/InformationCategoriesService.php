<?php
namespace App\Services;

use App\Models\InformationCategories;

class InformationCategoriesService extends Service
{
    /**
     * 基本クエリ.
     * 
     * @return Illuminate\Database\Eloquent\Builder
     */
    private function base()
    {
        return InformationCategories::query()
            ->select([
                'information_categories.*',
            ]);
    }

    /**
     * お知らせ種別全件取得.
     * 
     * @return array
     */
    public function getAll()
    {
        return $this->base()
            ->get()
            ->toArray();
    }

    /**
     * お知らせ種別取得.
     * 
     * @param int $id
     * @return array
     */
    public function getById($id)
    {
        return $this->base()
            ->where('id', $id)
            ->first()
            ->toArray();
    }
}
