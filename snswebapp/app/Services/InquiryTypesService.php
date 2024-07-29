<?php
namespace App\Services;

use App\Models\InquiryTypes;
use Illuminate\Support\Facades\Cache;

/**
 * お問い合わせ種別サービスクラス.
 *
 * @author s-watanabe-apps
 * @since 2024-01-01
 * @version 1.0.0
 */
class InquiryTypesService extends Service
{
    /**
     * 基本クエリ.
     *
     * @return Illuminate\Database\Eloquent\Builder
     */
    private function base()
    {
        return InquiryTypes::query()
            ->select([
                'inquiry_types.*',
            ])->orderBy('id');
    }

    /**
     * お知らせ種別取得.
     *
     * @return array
     */
    public function getInquiryTypes()
    {
        return $this->base()->get()->toArray();
    }

    public function save($params)
    {
        $this->base()->delete();

        $types = array_map(function($id, $name){
            return ['id' => $id, 'name' => $name];
        }, $params['ids'], $params['names']);

        foreach ($types as $type) {
            InquiryTypes::insert($type);
        }
    }
}
