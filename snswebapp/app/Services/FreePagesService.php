<?php
namespace App\Services;

use App\Http\Exceptions\NotFoundException;
use App\Http\Exceptions\ForbiddenException;
use App\Models\FreePages;
use App\Http\Requests\ManagementsFreepagesRequest;

class FreePagesService extends Service
{
    /**
     * 基本クエリ.
     *
     * @return Illuminate\Database\Eloquent\Builder
     */
    private function base() {
        return FreePages::query()
            ->select([
                'free_pages.*',
            ]);
    }

    /**
     * フリーページ全件取得.
     *
     * @param string $keyword
     * @param int $status
     * @param int $sortkey
     *
     * @return array
     */
    public function getFreepages($keyword, $status, $sortkey)
    {
        $sortkey = $sortkey ?? -1;

        $freepage_management_headers = [
            1 => [
                'sortkey' => 'free_pages.id',
                'header_name' => __('strings.id')
            ],
            2 => [
                'sortkey' => 'free_pages.title',
                'header_name' => __('strings.title'),
            ],
            3 => [
                'sortkey' => 'free_pages.created_at',
                'header_name' => __('strings.created_at'),
            ],
            4 => [
                'sortkey' => 'free_pages.updated_at',
                'header_name' => __('strings.updated_at'),
            ],
            5 => [
                'sortkey' => 'free_pages.status',
                'header_name' => __('strings.status'),
            ],
        ];

        $query = $this->base();

        if (!is_null($keyword)) {
            $like_keyword = '%' . addcslashes($keyword, '%_\\') . '%';
            $query->where('free_pages.title', 'like', $like_keyword);
        }

        if (!is_null($status)) {
            $query->where('free_pages.status', $status);
        }

        // 並べ替え
        $sortkey_name = $freepage_management_headers[abs($sortkey)]['sortkey'];
        $sortkey_order = $sortkey > 0 ? 'asc' : 'desc';
        $query->orderBy($sortkey_name, $sortkey_order);

        $result = $query->get();

        // ヘッダー用のパラメータ
        $query_string = http_build_query([
            'keyword' => $keyword,
            'status' => $status,
        ]);

        // ヘッダー生成
        $headers = array_map(function($key, $value) use($query_string, $sortkey) {
                return [
                    'name' => $value['header_name'] . (
                        $sortkey == $key ?
                        parent::SORTED_ASC :
                        ($sortkey == -$key ? parent::SORTED_DESC : '')
                    ),
                    'link' => "/managements/freepages?{$query_string}&sort=" . ($sortkey == $key ? -$sortkey : $key),
                ];
            },
            array_keys($freepage_management_headers),
            array_values($freepage_management_headers)
        );

        return [$result->toArray(), $headers];
    }

    /**
     * フリーページ取得.
     *
     * @return array
     */
    public function get($id)
    {
        return $this->base()
            ->where(['free_pages.id' => $id])
            ->first()
            ->toArray();
    }

    /**
     * フリーページ新規作成処理.
     *
     * @param array $values
     * @return array
     */
    public function insertFreePages(array $values)
    {
        $id = FreePages::insertGetId([
            'title' => $values['title'],
            'code' => $values['code'],
            'body' => $values['body'],
            'created_at' => carbon(),
        ]);

        $this->cacheForget(Service::CACHE_KEY_INFORMATIONS);

        return $this->get($id);
    }

    /**
     * フリーページ更新処理.
     *
     * @param array $values
     * @return array
     */
    public function updateInformations(array $values)
    {
        $id = $values['id'];
        unset($values['id']);

        $values['updated_at'] = carbon();

        $result = FreePages::where('id', $id)->update($values);

        return $this->get($id);
    }

    /**
     * Get free page by code.
     *
     * @param string $code
     * @return App\Models\FreePages
     */
    public function getByCode(string $code)
    {
        return $this->base()->where(['code' => $code,])->first();
    }

}
