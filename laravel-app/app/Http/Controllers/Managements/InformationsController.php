<?php

namespace App\Http\Controllers\Managements;

use App\Models\Informations;
use Illuminate\Http\Request;

class InformationsController extends ManagementsController
{
    public function index(Request $request)
    {
        $informations = Informations::getAllInformations();
        
        return view('managements.informations.index', compact(
            'informations'
        ));
    }

}
