<?php

namespace App\Http\Controllers;

use App\Models\FreePages;
use App\Http\Requests\AppRequest;

class PageController extends Controller
{
    /**
     * Get free page.
     * 
     * @param App\Http\Requests\AppRequest
     * @return Illuminate\View\View
     */
    public function get(AppRequest $request)
    {
        $values = FreePages::getByCode($request->code);

        return view('page.viewer', compact(
            'values'
        ));
    }
}
