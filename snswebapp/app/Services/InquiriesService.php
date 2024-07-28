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

    /**
     * お問い合わせ新規作成.
     *
     * @param array $values
     * @return int
     */
    public function insertInquiries(array $values)
    {
        if (auth()->check()) {
            $values['user_id'] = user()->id;
        }

        $values['status'] = \Status::ENABLED;
        $values['created_at'] = carbon();

        $id = Inquiries::insertGetId($values);

        return $id;
    }

}
