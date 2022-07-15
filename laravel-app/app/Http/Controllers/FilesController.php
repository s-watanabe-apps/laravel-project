<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FilesController extends Controller
{
    /**
     * Get files.
     * 
     * @param Illuminate\Http\Request
     * @return Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function get(Request $request)
    {
        $path = storage_path('app/contents/files/');

        $filePath = $path . $request->fileName;

        if (is_readable($filePath)) {
            return response()->file($filePath);
        }
    }

}
