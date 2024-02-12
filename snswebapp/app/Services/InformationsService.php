<?php
namespace App\Services;

use App\Http\Exceptions\NotFoundException;
use App\Http\Exceptions\ForbiddenException;
use App\Models\Informations;
use App\Models\InformationMarks;
use App\Requests\ManagementsInformationsRequest;

class InformationsService extends Service
{
    /**
     * ベースクエリ.
     * 
     * @return Illuminate\Database\Eloquent\Builder
     */
    private function base() {
        return Informations::query()
            ->select([
                'informations.id',
                'informations.category_id',
                'information_categories.style',
                'informations.title',
                'informations.body',
                'informations.status',
                'informations.start_time',
                'informations.end_time',
            ])->join('information_categories', 'informations.category_id', '=', 'information_categories.id');
    }

    /**
     * 有効なお知らせ一覧取得.
     * 
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function get_enabled() {
        $now = carbon();
        $cache = $this->remember(parent::CACHE_KEY_INFORMATIONS, function() use($now) {
            $data = $this->base()
                ->addSelect([\DB::raw('datediff(now(), informations.start_time) <= 7 as is_new'),])
                ->where('status', \Status::ENABLED)
                ->where('start_time', '<=', $now)
                ->where(function($query) use($now) {
                    $query->where('end_time', '>=', $now)
                        ->orWhereNull('end_time');
                })->orderBy('start_time')
                ->get();
            return json_encode($data);
        });

        return $cache;
    }

    /**
     * お知らせ全件取得.
     * 
     * @param string $keyword
     * @param int $category_id
     * @param int $sortkey
     * 
     * @return array
     */
    public function get_all_informations(string $keyword = null, string $category_id = null, $sortkey = null)
    {
        $sortkey = $sortkey ?? -1;

        $information_management_headers = [
            1 => [
                'sortkey' => 'informations.id',
                'header_name' => __('strings.id')
            ],
            2 => [
                'sortkey' => 'informations.title',
                'header_name' => __('strings.title'),
            ],
            3 => [
                'sortkey' => 'informations.start_time',
                'header_name' => __('strings.start_time'),
            ],
            4 => [
                'sortkey' => 'informations.end_time',
                'header_name' => __('strings.end_time'),
            ],
            5 => [
                'sortkey' => 'informations.status',
                'header_name' => __('strings.status'),
            ],
        ];

        $query = $this->base();

        if (!is_null($keyword)) {
            $like_keyword = '%' . addcslashes($keyword, '%_\\') . '%';
            $query->where('informations.title', 'like', $like_keyword);
        }

        if (!is_null($category_id) && $category_id != '0') {
            $query->where('informations.category_id', $category_id);
        }

        // 並べ替え
        $sortkey_name = $information_management_headers[abs($sortkey)]['sortkey'];
        $sortkey_order = $sortkey > 0 ? 'asc' : 'desc';
        $query->orderBy($sortkey_name, $sortkey_order);
        
        $result = $query->get();

        // ヘッダー用のパラメータ
        $query_string = http_build_query([
            'keyword' => $keyword,
            'category_id' => ($category_id != 0) ? '' : $category_id,
        ]);

        // ヘッダー生成
        $headers = array_map(function($key, $value) use($query_string, $sortkey) {
                return [
                    'name' => $value['header_name'] . ($sortkey == $key ? '▲' : ($sortkey == -$key ? '▼' : '')),
                    'link' => "/managements/informations?{$query_string}&sort=" . ($sortkey == $key ? -$sortkey : $key),
                ];
            },
            array_keys($information_management_headers),
            array_values($information_management_headers)
        );

        return [$result->toArray(), $headers];
    }

    /**
     * お知らせ取得.
     * 
     * @return array
     */
    public function get_by_id($id)
    {
        return $this->base()
            ->where(['informations.id' => $id])
            ->first()
            ->toArray();
    }

    /**
     * Update or create record.
     * 
     * @var App\Requests\ManagementsInformationsRequest
     * @return App\Models\Informations
     */
    public function save($request)
    {
        if (isset($request->id)) {
            // Update
            $informations = $this->get($request->id);
            throw_if(!$informations, NotFoundException::class);

            foreach ($request->validated() as $key => $value) {
                $informations->$key = $value;
            }
        } else {
            // Insert
            $informations = new Informations();
            $informations->fill($request->validated())->save();
        }

        $informations->status = $request->status ?? \Status::DISABLED;

        $informations->save();

        $this->cacheForget(Service::CACHE_KEY_INFORMATIONS);

        return $informations;
    }

    /**
     * Get information mark.
     * 
     * @param int $id
     * @return int
     */
    public function getInformationMark($id)
    {
        $result = InformationMarks::query(['mark'])->where('id', $id)->first();
        return $result->mark;
    }
}
