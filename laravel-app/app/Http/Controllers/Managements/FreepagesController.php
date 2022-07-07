<?php

namespace App\Http\Controllers\Managements;

//use App\Models\Informations;
//use App\Models\InformationMarks;
use App\Http\Requests\ManagementsFreepagesPostRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class FreepagesController extends ManagementsController
{
    /**
     * Get information list.
     * 
     * @param Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $freepages = [];

        return view('managements.freepages.index', compact(
            'freepages'
        ));
    }

    public function create(Request $request)
    {
        $free_page_code = Str::random(32);

        return view('managements.freepages.editor', compact(
            'free_page_code'
        ));
    }


    public function get(Request $request)
    {
        $information = Informations::get($request->id);

        return view('managements.freepages.get', compact(
            'information'
        ));
    }

    public function confirm(ManagementsFreepagesPostRequest $request)
    {
        
        return view('managements.freepages.confirm', compact('request'));
    }

/*
    public function create(Request $request)
    {
        $informationMarks = InformationMarks::get();

        return view('managements.informations.create', compact(
            'informationMarks'
        ));
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
*/
}
