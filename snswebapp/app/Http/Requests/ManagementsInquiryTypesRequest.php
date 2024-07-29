<?php
namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;

class ManagementsInquiryTypesRequest extends AppFormRequest
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
            'ids' => 'array',
            'ids.*' => 'required|numeric|max:10|distinct',
            'names' => 'array',
            'names.*' => 'required|max:255|distinct',
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
            'ids' => __('strings.id'),
            'ids.*' => __('strings.id'),
            'names' => __('strings.inquiry_types'),
            'names.*' => __('strings.inquiry_types'),
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
