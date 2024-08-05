<?php
namespace App\Services;

/**
 * ファイルサービスクラス.
 *
 *
 */
class FilesService extends Service
{
    static $extensions = [
        'txt', 'pdf', 'zip', 'png', 'gif', 'jpg',
    ];

    static $mineTypes = [
        'txt' => 'text/plain',
        'pdf' => 'application/pdf',
        'zip' => 'application/zip',
        'png' => 'image/png',
        'gif' => 'image/gif',
        'jpg' => 'image/jpeg',
    ];

    public static function getRegex()
    {
        return sprintf(".*[%s]", implode(',', array_map(
            function($value) {
              return '\.' . $value;
            },
            self::$extensions
        )));

    }

    /**
     * アップロードファイル全件取得.
     *
     * @param string $keyword
     * @param int $ext
     * @param int $sortkey
     *
     * @return array
     */
    public function getFiles($keyword, $ext, $sortkey)
    {
        $sortkey = $sortkey ?? -3;

        $file_headers = [
            1 => __('strings.file_name'),
            2 => __('strings.created_at'),
            3 => __('strings.updated_at'),
        ];

        // ファイル取得
        $files = array_map(
            function($file) {
                return [
                    'filename' => $file->getFilename(),
                    'ext' => $file->getExtension(),
                    'created_at' => filectime($file->getPathName()),
                    'updated_at' => filemtime($file->getPathName()),
                ];
            }, \File::files(storage_path('app/contents/files/'))
        );

        // フィルター
        $files = array_filter(
            $files,
            function($v) use($keyword, $ext) {
                if (!is_null($keyword)) {
                    if (mb_strpos($v['filename'], $keyword) === false) {
                        return false;
                    }
                }

                if (!is_null($ext)) {
                    if (strcmp($v['ext'], $ext) != 0) {
                        return false;
                    }
                }

                return true;
            }
        );

        // 並べ替え
        usort($files, function($v1, $v2) use($sortkey) {
            $reverse = $sortkey > 0 ? 1 : -1;
            if (abs($sortkey) == 1) {
                return strcmp($v1['filename'], $v2['filename']) * $reverse;
            } else if (abs($sortkey) == 2) {
                return strcmp($v1['created_at'], $v2['created_at']) * $reverse;
            } else {
                return strcmp($v1['updated_at'], $v2['updated_at']) * $reverse;
            }
        });

        // ヘッダー用のパラメータ
        $query_string = http_build_query([
            'keyword' => $keyword,
            'ext' => $ext,
        ]);

        // ヘッダー生成
        $headers = array_map(function($key, $value) use($query_string, $sortkey) {
                return [
                    'name' => $value . (
                        $sortkey == $key ?
                        parent::SORTED_ASC :
                        ($sortkey == -$key ? parent::SORTED_DESC : '')
                    ),
                    'link' => "/managements/uploadfiles?{$query_string}&sort=" . ($sortkey == $key ? -$sortkey : $key),
                ];
            },
            array_keys($file_headers),
            array_values($file_headers)
        );

        return [$files, $headers];
    }

}
