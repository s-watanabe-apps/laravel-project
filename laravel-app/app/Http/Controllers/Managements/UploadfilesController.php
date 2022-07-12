<?php

namespace App\Http\Controllers\Managements;

use App\Models\FreePages;
use App\Http\Requests\AppRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UploadfilesController extends ManagementsController
{
    /**
     * Get upload files.
     * 
     * @param App\Http\Requests\AppRequest
     * @return Illuminate\View\View
     */
    public function index(AppRequest $request)
    {
        $path = storage_path('app/contents/files/');
        $files = \File::files($path);

        

        foreach ($files as $v) {
            var_dump($v->getfileName());
        }

        return view('managements.uploadfiles.index', compact(
            'files'
        ));
    }

}
