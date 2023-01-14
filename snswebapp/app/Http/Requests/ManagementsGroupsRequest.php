<?php
namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;

class ManagementsGroupsRequest extends AppFormRequest
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
            'codes' => 'array',
            'codes.*' => 'required|max:10|distinct',
            'names' => 'array',
            'names.*' => 'required|max:255|distinct',
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
            'codes' => __('strings.group_code'),
            'codes.*' => __('strings.group_code'),
            'names' => __('strings.group_name'),
            'names.*' => __('strings.group_name'),
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
