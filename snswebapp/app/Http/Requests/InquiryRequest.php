<?php
namespace App\Http\Requests;

class InquiryRequest extends AppFormRequest
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
            'type' => 'required|exists:information_categories,id',
            'body' => 'required|string',
        ];

        if (!auth()->check()) {
            $rules['name'] = 'required|string|max:255';
            $rules['email'] = 'required|email|max:255';
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
            'type' => __('strings.inquiry_type'),
            'body' => __('strings.inquiry_body'),
            'name' => __('strings.name'),
            'email' => __('strings.email'),
        ];
    }
}
