<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppFormRequest extends FormRequest
{
    public function isPost()
    {
        return strcmp(strtolower($this->method()), 'post') == 0;
    }
}