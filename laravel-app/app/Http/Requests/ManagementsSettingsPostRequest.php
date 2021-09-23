<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ManagementsSettingsPostRequest extends FormRequest
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
        $rules = [
            'site_name' => 'required|max:255',
            'basic_auth' => 'required|in:0,1',
            'basic_user' => 'required|max:255',
            'basic_password' => 'required|max:255',
        ];

        if ($this->basic_auth == '0') {
            unset($rules['basic_user']);
            unset($rules['basic_password']);
        }

        return $rules;
    }

    /**
     * Column names.
     * 
     * @return array
     */
    public function attributes()
    {
        return [
            'site_name' => 'サイト名',
            'basic_auth' => 'ベーシック認証',
        ];
    }
}
