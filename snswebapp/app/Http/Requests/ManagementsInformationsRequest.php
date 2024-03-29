<?php
namespace App\Http\Requests;

use App\Models\Informations;

class ManagementsInformationsRequest extends AppFormRequest
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
            'id' => 'integer|min:1',
            'title' => 'required|max:255',
            'body' => 'required',
            'start_time' => 'required|date_format:Y/m/d H:i',
            'end_time' => [
                'nullable',
                'date_format:Y/m/d H:i',
                function($attribute, $value, $fail) {
                    $start_datetime = carbon($this->start_time);
                    $end_datetime = carbon($this->end_time);
                    if ($end_datetime <= $start_datetime) {
                        $fail(__('strings.end_time_invalid'));
                    }
                },
            ],
            'status' => 'in:' . implode(',', [
                \Status::ENABLED,
                \Status::DISABLED,
            ]),
            'category_id' => 'required|min:1|exists:information_categories,id',
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
            'id' => '予期せぬ入力値が送信されました。初めからやり直してください。',
            'title' => __('strings.title'),
            'body' => __('strings.body'),
            'start_time' => __('strings.start_time'),
            'end_time' => __('strings.end_time'),
            'status' => __('strings.status'),
        ];
    }
}
