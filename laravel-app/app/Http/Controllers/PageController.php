<?php

namespace App\Http\Controllers;

use App\Models\FreePages;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Get free page.
     * 
     * @param Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function get(Request $request)
    {
        $values = FreePages::getByCode($request->code);

        return view('page.viewer', compact(
            'values'
        ));
    }
}
