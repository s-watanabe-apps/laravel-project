<?php

namespace App\Http\Controllers\Managements;

use App\Models\FreePages;
//use App\Http\Requests\ManagementsFreepagesPostRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UploadfilesController extends ManagementsController
{
    /**
     * Get upload files.
     * 
     * @param Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
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
