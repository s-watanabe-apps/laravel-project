<?php
namespace App\Services;

use App\Models\InformationMarks;

class InformationMarksService extends Service
{
    public function query()
    {
        return InformationMarks::query()
            ->select([
                'information_marks.id',
                'information_marks.mark',
            ]);
    }

    public function all()
    {
        return $this->query()->get();
    }

    public function getById($id)
    {
        return $this->query()->where('id', $id)->first();
    }
}
