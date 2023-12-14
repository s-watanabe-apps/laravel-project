<?php
namespace App\Http\Requests;

class ResetPasswordRequest extends AppFormRequest
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
            'password' =>  'required|min:8|string',
            'password_confirm' => 'same:password',
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
            'password' => __('strings.password'),
            'password_confirm' => __('strings.confirm'),
        ];
    }
}
