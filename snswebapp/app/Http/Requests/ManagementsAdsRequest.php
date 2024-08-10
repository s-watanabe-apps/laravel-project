<?php
namespace App\Http\Requests;

use App\Models\Ads;
use App\Rules\CheckScript;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;

class ManagementsAdsRequest extends AppFormRequest
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
            'type' => ['required', Rule::in(array_keys(Ads::getTypes()))],
            'title' => 'array',
            'title.*' => 'required|max:3',
            'body' => 'array',
            'body.*' => 'required|max:3',
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
            'title.*' => __('strings.title'),
            'body' => __('strings.body'),
            'body.*' => __('strings.body'),
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
