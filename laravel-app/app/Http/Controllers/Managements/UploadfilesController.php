<?php
namespace App\Http\Controllers\Managements;

use App\Models\FreePages;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UploadfilesController extends ManagementsController
{
    /**
     * Get upload files.
     * 
     * @param Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
        $files = array_map(
            function($file) {
                $file->createdAt = Carbon::createFromTimestamp(filectime($file->getPathName()));
                $file->updatedAt = Carbon::createFromTimestamp(filemtime($file->getPathName()));
                return $file;
            },
            \File::files(storage_path('app/contents/files/'))
        );

        return view('managements.uploadfiles.index', compact(
            'files'
        ));
    }

}
