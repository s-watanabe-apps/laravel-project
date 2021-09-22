<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticlePostRequest extends FormRequest
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
            'subject' => 'required|max:255',
            'body' => 'string',
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
            'subject' => __('strings.title'),
            'body' => __('strings.article_body'),
        ];
    }
}
