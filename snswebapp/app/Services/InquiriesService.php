<?php
namespace App\Services;

use App\Models\Inquiries;
use Illuminate\Support\Facades\Cache;

/**
 * お問い合わせサービスクラス.
 *
 * @author s-watanabe-apps
 * @since 2024-01-01
 * @version 1.0.0
 */
class InquiriesService extends Service
{
    /**
     * 基本クエリ.
     *
     * @return Illuminate\Database\Eloquent\Builder
     */
    private function base()
    {
        return Inquiries::query()
            ->select([
                'inquiries.*',
            ])->orderBy('id');
    }
}
