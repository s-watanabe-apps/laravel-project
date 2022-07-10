<?php
namespace App\Http\Controllers;

use App\Http\Requests\AppRequest;

class FilesController extends Controller
{
    /**
     * Get files.
     * 
     * @param  \Illuminate\Http\Request
     */
    public function get(AppRequest $request)
    {
        $path = storage_path('app/contents/files/');

        $filePath = $path . $request->fileName;

        if (is_readable($filePath)) {
            return response()->file($filePath);
        }
    }

}
