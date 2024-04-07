<?php
namespace App\Http\Requests;

use App\Models\Images;
use App\Models\Profiles;
use App\Libs\ProfileInputType;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;

class ManagementsProfilesRequest extends AppFormRequest
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
     * TODO
     * @return array
     */
    public function rules()
    {
        return [
            'is_display_email' => 'in:on',
            'is_editable_email' => 'in:on',
            'is_display_name' => 'in:on',
            'is_editable_name' => 'in:on',
            'is_display_birthdate' => 'in:on',
            'is_editable_birthdate' => 'in:on',
            'is_display_group' => 'in:on',
            'is_editable_group' => 'in:on',
            'types' => [
                'array',
                Rule::in(array_keys(ProfileInputType::getTypes())),
            ],
            'names' => 'array',
            'names.*' => 'required|max:255',
            'orders' => 'array',
            'orders.*' => 'nullable|numeric',
            'choices' => 'array',
            'choices.*' => 'nullable|string'
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
            'orders' => __('strings.sort_order'),
            'orders.*' => __('strings.sort_order'),
            'choices' => __('strings.select_list'),
            'choices.*' => __('strings.select_list'),
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
