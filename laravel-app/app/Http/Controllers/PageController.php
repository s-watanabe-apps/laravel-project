<?php

namespace App\Http\Controllers;

use App\Models\FreePages;
use App\Http\Requests\AppRequest;

class PageController extends Controller
{
    /**
     * index Get.
     * 
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\View\View
     */
    public function get(AppRequest $request)
    {
        $values = FreePages::getByCode($request->code);

        return view('page.viewer', compact(
            'values'
        ));
    }
}
