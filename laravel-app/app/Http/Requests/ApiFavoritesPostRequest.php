<?php

namespace App\Http\Requests;

use App\Models\Favorites;
use Illuminate\Foundation\Http\FormRequest;

class ApiFavoritesPostRequest extends FormRequest
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
        $favoriteCodes = implode('|', array_keys(Favorites::getFavoriteNames()));
        $rules = [
            'isFavorite' => 'required|boolean',
            'uri' => ['required', sprintf('regex:/^\/(%s)\/[0-9]{1,}$/', $favoriteCodes)],
        ];
        return $rules;
    }
}
