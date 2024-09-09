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
        $rules = [
            'type' => ['required', Rule::in(array_keys(Ads::getTypes()))],
            //'title.0' => 'string|nullable|max:30',
            //'body.0' => ['required_with:title.0', 'max:5000', new CheckScript()],
            //'title.1' => 'string|nullable|max:30',
            //'body.1' => ['required_with:title.1', 'max:5000', new CheckScript()],
            //'title.2' => 'string|nullable|max:30',
            //'body.2' => ['required_with:title.2', 'max:5000', new CheckScript()],
            'start_time' => 'array',
            'start_time.*' => 'nullable|date_format:Y/m/d H:i',
            'end_time' => 'array',
            'end_time.*' => 'nullable|date_format:Y/m/d H:i',
        ];

        for ($i = 0; $i < max([Ads::LIMIT_SIDE, Ads::LIMIT_LIST, Ads::LIMIT_FOOTER]); $i++) {
            $rules['title.' . $i] = 'string|nullable|max:30';
            $rules['body.' . $i] = ['required_with:title.' . $i, 'max:5000', new CheckScript()];
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
            'title.0' => __('strings.title'),
            'body.0' => __('strings.body'),
            'title.1' => __('strings.title'),
            'body.1' => __('strings.body'),
            'title.2' => __('strings.title'),
            'body.2' => __('strings.body'),
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
