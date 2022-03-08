<?php

namespace App\Http\Requests;

use App\Models\Informations;
use Illuminate\Foundation\Http\FormRequest;

class ManagementsInformationsPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|title|max:255',
            'body' => 'required',
            'start_time' => 'required|date_format:Y/m/d H:i',
            'end_time' => 'nullable|date_format:Y/m/d H:i',
            'status' => 'required|in:' . implode(',', array_keys(Informations::getStatuses())),
        ];
    }

    /**
     * Column names.
     * 
     * @return array
     */
    public function attributes()
    {
        return [
            'title' => __('strings.title'),
            'body' => __('strings.body'),
            'start_time' => __('strings.start_time'),
            'end_time' => __('strings.end_time'),
            'status' => __('strings.status'),
        ];
    }
}
