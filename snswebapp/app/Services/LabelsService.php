<?php
namespace App\Services;

use App\Http\Exceptions\NotFoundException;
use App\Models\Labels;

class LabelsService extends Service
{
    /**
     * Get base query builder.
     * 
     * @return Illuminate\Database\Eloquent\Builder
     */
    private function base()
    {
        return Labels::query()
            ->select([
                'labels.id',
                'labels.value',
            ]);
    }

    /**
     * Get labels by id.
     * 
     * @param int $id
     * @return array
     */
    public function get(int $id)
    {
        $data = $this->base()->where('labels.id', $id)->first();

        if (!$data) {
            throw new NotFoundException();
        }

        return $data;
    }

    /**
     * Get labels by ids.
     * 
     * @param array $ids
     * @return array
     */
    public function getByIds(array $ids)
    {
        return $this->base()->whereIn('labels.id', $ids)->get();
    }

    /**
     * ラベル逆引き検索.
     * 
     * @param string $label_name
     * 
     * @return int
     */
    public function get_id_by_name(string $label_name)
    {
        return $this->base()->where('labels.value', $label_name)->first();
    }

    /**
     * ラベル配列生成.
     * 
     * @param string $value
     * 
     * @return array
     */
    public function str_to_labels(string $value)
    {
        $labels = [];

        $labelsString = preg_replace('/\s+/', ' ', trim($value));

        if ($labelsString != '') {
            $labels = array_unique(explode(' ', $labelsString));
        }

        return $labels;
    }

}
