<?php

namespace App\Http\Controllers\Managements;

use App\Models\Informations;
use App\Http\Requests\ManagementsInformationsPostRequest;
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

    public function get(Request $request)
    {
        $information = Informations::where(['id' => $request->id])->get()->first();

        return view('managements.informations.get', compact(
            'information'
        ));
    }

    public function create(Request $request)
    {
        return view('managements.informations.create');
    }

    public function confirm(ManagementsInformationsPostRequest $request)
    {
        return view('managements.informations.confirm', compact('request'));
    }
}
