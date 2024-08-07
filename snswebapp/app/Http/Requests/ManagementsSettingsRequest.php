<?php
namespace App\Http\Requests;

class ManagementsSettingsRequest extends AppFormRequest
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
        $rules = [
            'site_name' => 'required|max:255',
            'site_description' => 'max:255',
            'user_create_any' => 'in:1',
            'user_create_member' => 'in:1',
            //'user_create_admin' => 'in:1',
            'basic_auth' => 'required|in:0,1',
            'basic_user' => 'required|max:255',
            'basic_password' => 'required|max:255',
            'anonymous_permission' => 'required|in:0,1',
            'theme_id' => 'required|exists:themes,id',
            //'header_image_id' => 'required|exists:header_images,id',
            //'login_image_id' => 'required|exists:login_images,id',
            'title_informations' => 'required|max:255',
            'title_latest_articles' => 'required|max:255',
        ];

        if ($this->basic_auth == '0') {
            $rules['basic_user'] = 'max:255';
            $rules['basic_password'] = 'max:255';
        }

        return $rules;
    }

    /**
     * Column names.
     * 
     * @return array
     */
    public function attributes()
    {
        return [
            'site_name' => __('strings.site_name'),
            'site_description' => __('strings.site_description'),
            'basic_auth' => __('strings.basic_auth'),
            'anonymous_permission' => __('strings.anonymous_user'),
            'title_informations' => __('strings.title_informations'),
            'title_latest_articles' => __('strings.title_latest_articles'),
        ];
    }
}
