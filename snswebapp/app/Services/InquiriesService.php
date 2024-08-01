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
                \DB::raw('inquiry_types.name as type_name'),
                \DB::raw('ifnull(inquiries.name, users.name) as user_name'),
                \DB::raw('reply_user.name'),
            ])->join('inquiry_types', 'inquiries.type', 'inquiry_types.id')
            ->leftJoin('users', function ($join) {
                $join->on('users.id', '=', 'inquiries.user_id')
                    ->whereNull('users.deleted_at');
            })->leftJoin(\DB::raw('users as reply_user'), function ($join) {
                $join->on('reply_user.id', '=', 'inquiries.reply_user_id')
                    ->whereNull('users.deleted_at');
            });
    }

    /**
     * お知らせ一覧取得.
     *
     * @param string $keyword
     * @param int $type
     * @param int $sortkey
     * @return array
     */
    public function getInquiries($keyword = null, $type = null, $sortkey = null)
    {
        $sortkey = $sortkey ?? -1;

        $user_management_headers = [
            1 => [
                'sortkey' => 'inquiries.id',
                'header_name' => __('strings.id')
            ],
            2 => [
                'sortkey' => 'type_name',
                'header_name' => __('strings.inquiry_type'),
            ],
            3 => [
                'sortkey' => 'user_name',
                'header_name' => __('strings.name'),
            ],
            4 => [
                'sortkey' => 'inquiries.created_at',
                'header_name' => __('strings.created_at'),
            ],
            5 => [
                'sortkey' => 'inquiries.status',
                'header_name' => __('strings.status'),
            ],
            6 => [
                'sortkey' => 'inquiries.text',
                'header_name' => __('strings.inquiry_body'),
            ],
        ];

        $query = $this->base()->whereNull('reply_inquiry_id');

        if (!is_null($keyword)) {
            $like_keyword = '%' . addcslashes($keyword, '%_\\') . '%';
            $query->where(function($sub) use($like_keyword) {
                $sub->where('users.email', 'like', $like_keyword)
                    ->orWhere('users.name', 'like', $like_keyword)
                    ->orWhere('inquiries.text', 'like', $like_keyword);
            });
        }

        if (!is_null($type) && $type != '0') {
            $query->where('inquiries.type', $type);
        }

        // 並べ替え
        $sortkey_name = $user_management_headers[abs($sortkey)]['sortkey'];
        $sortkey_order = $sortkey > 0 ? 'asc' : 'desc';
        $query->orderBy($sortkey_name, $sortkey_order);

        $result = $query->get();

        // ヘッダー用のパラメータ
        $query_string = http_build_query([
            'keyword' => $keyword,
            'type' => ($type != 0) ? '' : $type,
        ]);

        // ヘッダー生成
        $headers = array_map(function($key, $value) use($query_string, $sortkey) {
                return [
                    'name' => $value['header_name'] . (
                        $sortkey == $key ?
                        parent::SORTED_ASC :
                        ($sortkey == -$key ? parent::SORTED_DESC : '')
                    ),
                    'link' => "/managements/inquiries?{$query_string}&sort=" . ($sortkey == $key ? -$sortkey : $key),
                ];
            },
            array_keys($user_management_headers),
            array_values($user_management_headers)
        );

        return [$result->toArray(), $headers];
    }

    /**
     * お問い合わせ取得.
     *
     * @param int $id
     * @return array
     */
    public function getInquiry(int $id)
    {
        return $this->base()
            ->where('inquiries.id', $id)
            ->first()->toArray();
    }

    public function getInquiryReplys(int $replyInquiryId)
    {
        return $this->base()
            ->where('reply_inquiry_id', $replyInquiryId)
            ->orderBy('created_at', 'asc')
            ->get()->toArray();
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

        $values['status'] = Inquiries::STATUS_NOT_ANSWERED;
        $values['created_at'] = carbon();

        $id = Inquiries::insertGetId($values);

        return $id;
    }

}
