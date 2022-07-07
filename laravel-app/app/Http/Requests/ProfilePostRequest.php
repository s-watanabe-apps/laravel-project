<?php

namespace App\Http\Requests;

use App\Models\Images;
use App\Models\Profiles;
use App\Libs\ProfileInputType;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Session;

class ProfilePostRequest extends AppFormRequest
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
        $profiles = Profiles::getProfilesHash();
        $choices = Profiles::getProfileChoicesHash();

        $dynamicRules = function($attribute, $value, $fail) use($profiles, $choices) {
            $index = (int) str_replace('dynamic_values.', '', $attribute);
            if (!array_key_exists($index, $profiles)) {
                $fail(__('validation.invalid_input'));
                return;
            }

            switch ($profiles[$index]->type) {
                case ProfileInputType::FILLIN:
                    $len = mb_strlen($value);
                    if ($len > 255) {
                        $fail(__('validation.too_long_input'));
                    }
                    if ($profiles[$index]->required && $len == 0) {
                        $fail(str_replace(':attribute', $profiles[$index]->name, __('validation.required')));
                    }
                    break;
                case ProfileInputType::DESCRIPTION:
                    $len = mb_strlen($value);
                    if ($profiles[$index]->required && $len == 0) {
                        $fail(str_replace(':attribute', $profiles[$index]->name, __('validation.required')));
                    }
                    break;
                case ProfileInputType::CHOICE:
                    if (!array_key_exists($profiles[$index]->id, $choices)) {
                        $fail(__('validation.invalid_input'));
                        break;
                    }
                    if (!array_key_exists($value, $choices[$profiles[$index]->id])) {
                        $fail(__('validation.invalid_input'));
                    }
                    break;
                default:
                    return;
            }
        };

        return [
            'name' => 'required|max:255',
            'name_kana' => 'required|max:255',
            'birth_date' => 'required|date',
            'choose_profile_image' => 'mimetypes:' . implode(',', array_keys(Images::getExtensions())),
            'dynamic_values.*' => $dynamicRules,
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
            'name' => __('strings.name'),
            'name_kana' => __('strings.name_kana'),
            'birth_date' => __('strings.birth_date'),
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
