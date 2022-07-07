<?php

namespace App\Http\Controllers\Managements;

use App\Models\FreePages;
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
        $freePages = FreePages::all();

        return view('managements.freepages.index', compact(
            'freePages'
        ));
    }

    public function create(Request $request)
    {
        $code = Str::random(32);

        $index = 2;

        return view('managements.freepages.editor', compact(
            'code', 'index'
        ));
    }

    public function confirm(ManagementsFreepagesPostRequest $request)
    {
        $values = $request->validated();

        return view('managements.freepages.viewer', compact(
            'values',
        ));
    }

    public function register(ManagementsFreepagesPostRequest $request)
    {

        \DB::transaction(function() use ($request) {
            if ($request->isPost()) {
                FreePages::add($request->validated());
            } else {

            }
        });

        return redirect()->route('managementsFreepages');
    }

    public function get(Request $request)
    {
        $freePage = FreePages::find($request->id);

        $values = $freePage->getAttributes();

        $index = 1;

        return view('managements.freepages.editor', compact(
            'values', 'index'
        ));
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
