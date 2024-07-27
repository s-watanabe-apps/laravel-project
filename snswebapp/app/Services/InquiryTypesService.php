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

    public function getInquiryTypes()
    {
        return $this->base()->get()->toArray();
    }
}
