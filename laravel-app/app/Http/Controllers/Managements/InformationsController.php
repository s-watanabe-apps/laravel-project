<?php

namespace App\Http\Controllers\Managements;

use App\Models\Informations;
use App\Http\Requests\ManagementsInformationsPostRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InformationsController extends ManagementsController
{
    /**
     * Get information list.
     * 
     * @param Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
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

    public function post(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            (new ManagementsInformationsPostRequest)->rules()
        );

        if ($validator->fails()) {
            abort(422);
        }

        $validated = $validator->validated();

        \DB::transaction(function() use ($validated) {
            $informations = new Informations();
            $informations->title = $validated['title'];
            $informations->body = $validated['body'];
            $informations->status = $validated['status'];
            $informations->start_time = $validated['start_time'];
            $informations->end_time = $validated['end_time'];
            $informations->save();
        });

        return redirect()->route('managementsInformations');
    }
}
