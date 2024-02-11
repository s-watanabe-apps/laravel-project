<?php
namespace App\Services;

use App\Models\InformationMarks;

class InformationMarksService extends Service
{
    /**
     * ベースクエリ.
     * 
     * @return Illuminate\Database\Eloquent\Builder
     */
    private function base()
    {
        return InformationMarks::query()
            ->select([
                'information_marks.id',
                'information_marks.mark',
            ]);
    }

    /**
     * お知らせ種別全件取得.
     * 
     * @return array
     */
    public function get_all()
    {
        return $this->base()->get()->toArray();
    }

    /**
     * お知らせ種別取得.
     * 
     * @param int $id
     * @return array
     */
    public function get_by_id($id)
    {
        return $this->base()->where('id', $id)->first()->toArray();
    }
}
