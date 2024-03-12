<?php
namespace App\Http\Controllers\Managements;

use App\Models\FreePages;
use App\Services\FilesService;
use App\Http\Requests\UploadFileRequest;
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
        $validator = Validator::make([
            'keyword' => $request->keyword,
            'ext' => $request->ext,
            'page' => $request->page,
            'sort' => $request->sort,
        ], [
            'keyword' => 'string|nullable',
            'ext' => 'nullable|in:' . implode(',', array_values($this->filesService::$extensions)),
            'page' => 'integer|nullable',
            'sort' => 'integer|nullable|min:-5|max:5',
        ]);
        if ($validator->fails()) {
            abort(404);
        }

        $validated = $validator->validated();

        $page = $validated['page'] ?? 1;
        list($files, $headers) = $this->filesService->getFiles($validated['keyword'], $validated['ext'], $validated['sort']);
        $files = $this->pager($files, 10, $page, '/managements/uploadfiles/');

        $extensions = array_keys($this->filesService::$mineTypes);

        return view('managements.uploadfiles.index', compact(
            'headers',
            'files',
            'extensions',
            'validated'
        ));
    }

    public function uploadFile(UploadFileRequest $request)
    {
        $validated = $request->validated();

        $file = $validated['file'];

        $file->storeAs('contents/files/', $file->getClientOriginalName());
        
        return redirect()->route('managementsUploadfiles');
    }
}
