<?php
namespace App\Http\Requests;

use App\Rules\OrRules;

class ManagementsUsersRequest extends AppFormRequest
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
            'email' => 'required|email|max:255|unique:users,email',
            'name' => 'nullable|max:255',
            'birthdate' => 'nullable|date_format:Y/m/d',
            'role_id' => 'integer|in:2,3',
            'group_code' => [new OrRules(['in:0', 'exists:groups,code'])],
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
            'email' => __('strings.email'),
            'name' => __('strings.name'),
            'birthdate' => __('strings.birthdate'),
            'role_id' => __('strings.role'),
            'group_code' => __('strings.group'),
        ];
    }
}
