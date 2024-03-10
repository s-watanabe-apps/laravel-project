<?php
namespace App\Http\Controllers\Managements;

use App\Models\FreePages;
use App\Services\FilesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

/**
 * ファイルアップロードコントローラ.
 * 
 * @author s-watanabe-apps
 * @since 2024-01-01
 * @version 1.0.0
 */
class UploadfilesController extends ManagementsController
{
    // サービス変数.
    private $filesService;

    /**
     * コンストラクタ.
     *
     * @param App\Services\FilesService
     * @return void
     */
    public function __construct(
        FilesService $filesService
    ) {
        $this->filesService = $filesService;
    }

    /**
     * アップロードファイル一覧.
     * 
     * @param Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
        $files = array_map(
            function($file) {
                return [
                    'filename' => $file->getFilename(),
                    'extension' => $file->getExtension(),
                    'created_at' => carbon(filectime($file->getPathName())),
                    'updated_at' => carbon(filemtime($file->getPathName())),
                ];
            }, \File::files(storage_path('app/contents/files/'))
        );

        $extensions = $this->filesService::$extensions;
dump($files);

        return view('managements.uploadfiles.index', compact(
            'files',
            'extensions'
        ));
    }

}
