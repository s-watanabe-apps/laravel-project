<?php

namespace App\Http\Requests;

use Carbon\Carbon;

class ApiEventsGetRequest extends AppFormRequest
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
            'start' => 'required|date',
            'end' => [
                'required',
                'date',
                function($attribute, $value, $fail) {
                    $start_datetime = Carbon::parse($this->start_time);
                    $end_datetime = Carbon::parse($this->end_time);
                    if ($end_datetime <= $start_datetime) {
                        $fail(__('strings.end_time_invalid'));
                    }
                },
            ],
        ];
    }
}
