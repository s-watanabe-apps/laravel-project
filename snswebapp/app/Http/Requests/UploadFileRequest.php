<?php
namespace App\Http\Requests;

use App\Services\FilesService;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Session;

class UploadFileRequest extends AppFormRequest
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
            'file' => 'required|mimetypes:' . implode(',', array_values(FilesService::$mineTypes)),
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
            'file' => __('strings.file'),
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
            'mimetypes' => sprintf(__('strings.errors.upload_file_minetypes'), implode(', ', array_keys(FilesService::$mineTypes))),
        ];
    }
}
