<?php

namespace App\Http\Controllers\Managements;

use App\Models\Informations;
use Illuminate\Http\Request;

class InformationsController extends ManagementsController
{
    public function index(Request $request)
    {
        $informations = Informations::getAllInformations();
        
        $dataTablesLanguage = json_encode(__('strings.datatables'), JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);

        return view('managements.informations.index', compact(
            'informations', 'dataTablesLanguage'
        ));
    }

}
