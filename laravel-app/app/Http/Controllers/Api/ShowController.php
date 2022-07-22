<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ShowController extends ApiController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('authcheck');
    }

    /**
     * image Get.
     * 
     * @param Illuminate\Http\Request
     * @return Illuminate\View\View
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
