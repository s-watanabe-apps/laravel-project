<?php
namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;

class ManagementsNavigationsRequest extends AppFormRequest
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
            'names' => 'array',
            'names.*' => 'required|max:10',
            'links' => 'array',
            'links.*' => 'required|max:255',
            'orders' => 'array',
            'orders.*' => 'nullable|numeric',
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
            'names' => __('strings.input_type_column_name'),
            'names.*' => __('strings.input_type_column_name'),
            'links' => __('strings.link'),
            'links.*' => __('strings.link'),
            'orders' => __('strings.sort_order'),
            'orders.*' => __('strings.sort_order'),
        ];
    }

    /**
     * Custom error messages.
     *
     * @return array
     */
    public function messages()
    {
        return [
        ];
    }
}
