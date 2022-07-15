<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class ShowController extends Controller
{
    /**
     * Get image file.
     * 
     * @param Illuminate\Http\Request
     * @return 
     */
    public function image(Request $request)
    {
        try {
            $validator = Validator::make([
                    'file' => $request->file,
                ], [
                    'file' => 'present',
                ]);
            if ($validator->fails()) {
                return;
            }

            $validated = $validator->validated();

            $filePath = storage_path('app/contents/images/');
            if (!is_null($validated['file'])) {
                $filePath .= $validated['file'];
            } else {
                $filePath .= 'profiles/no_image.png';
            }

            if (is_readable($filePath)) {
                return response()->file($filePath);
            }
        } catch (DecryptException $e) {
            return;
        }
    }
}
