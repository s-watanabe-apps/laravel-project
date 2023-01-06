<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppFormRequest extends FormRequest
{
    // Form request constants.
    const REQUEST_METHOD_POST = 'post';
    const REQUEST_METHOD_PUT = 'put';

    /**
     * Form request is post method.
     * 
     * @return boolean
     */
    public function isPost()
    {
        return strcmp(strtolower($this->method()), self::REQUEST_METHOD_POST) == 0;
    }

    /**
     * Form request is put method.
     * 
     * @return boolean
     */
    public function isPut()
    {
        return strcmp(strtolower($this->method()), self::REQUEST_METHOD_PUT) == 0;
    }
}