<?php

namespace App\Http\Controllers\Managements;

use App\Models\Informations;
use App\Models\InformationMarks;
use App\Http\Requests\AppRequest;
use App\Http\Requests\ManagementsInformationsPostRequest;
use Illuminate\Support\Facades\Validator;

class InformationsController extends ManagementsController
{
    /**
     * Get information list.
     * 
     * @param App\Http\Requests\AppRequest
     * @return Illuminate\View\View
     */
    public function index(AppRequest $request)
    {
        $informations = Informations::all();

        return view('managements.informations.index', compact(
            'informations'
        ));
    }

    /**
     * Get information.
     * 
     * @param App\Http\Requests\AppRequest
     * @return Illuminate\View\View
     */
    public function get(AppRequest $request)
    {
        $information = Informations::get($request->id);

        $informationMarks = InformationMarks::get();

        $method = AppRequest::PUT;

        return view('managements.informations.editor', compact(
            'information', 'informationMarks', 'method'
        ));
    }

    /**
     * Get create information form.
     * 
     * @param App\Http\Requests\AppRequest
     * @return Illuminate\View\View
     */
    public function create(AppRequest $request)
    {
        $informationMarks = InformationMarks::get();

        $method = AppRequest::POST;

        return view('managements.informations.editor', compact(
            'informationMarks', 'method'
        ));
    }


    /**
     * Confirmation of input contents.
     * 
     * @param App\Http\Requests\ManagementsInformationsPostRequest
     * @return Illuminate\View\View
     */
    public function confirm(ManagementsInformationsPostRequest $request)
    {
        $method = $request->method();

        return view('managements.informations.viewer', compact(
            'request', 'method'
        ));
    }

    /**
     * Register input information.
     * 
     * @param App\Http\Requests\ManagementsInformationsPostRequest
     * @return void
     */
    public function register(ManagementsInformationsPostRequest $request)
    {
        \DB::transaction(function() use ($request) {
            if ($request->isPost()) {
                Informations::add($request->validated());
            } else {

            }
        });

        return redirect()->route('managementsInformations');
    }
}
