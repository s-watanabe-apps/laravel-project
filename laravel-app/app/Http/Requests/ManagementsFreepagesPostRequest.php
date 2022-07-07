<?php

namespace App\Http\Requests;

class ManagementsFreepagesPostRequest extends AppFormRequest
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
            'title' => 'required|max:255',
            'free_page_code' => 'required|max:32',
            'body' => 'required',
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
            'free_page_code' => __('strings.free_page_code'),
            'body' => __('strings.body'),
        ];
    }
}
