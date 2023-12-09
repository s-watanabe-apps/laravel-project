<?php
namespace App\Http\Requests;

use App\Models\Images;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Session;

class PicturesUploadRequest extends AppFormRequest
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
            'title' => 'nullable|max:255',
            'comment' => 'nullable',
            'image' => 'mimetypes:' . implode(',', array_keys(Images::getExtensions())),
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
            'comment' => __('strings.comment'),
            'image' => __('strings.choose_file'),
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
