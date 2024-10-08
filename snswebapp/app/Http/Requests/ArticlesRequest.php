<?php
namespace App\Http\Requests;

use App\Rules\CheckScript;

class ArticlesRequest extends AppFormRequest
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
            'id' => 'nullable|numeric',
            'title' => 'required|max:255',
            'body' => ['nullable', 'string', new CheckScript()],
            'status' => 'in:0,1',
            'labels' => 'nullable|string',
            'link' => 'nullable|url',
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
            'body' => __('strings.article_body'),
            'status' => __('strings.display_flag'),
            'labels' => __('strings.labels'),
            'link' => __('strings.link'),
        ];
    }
}
