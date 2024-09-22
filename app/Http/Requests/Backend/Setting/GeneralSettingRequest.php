<?php

namespace App\Http\Requests\Backend\Setting;

use Illuminate\Foundation\Http\FormRequest;

class GeneralSettingRequest extends FormRequest
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
            'website_name'=>'required|string|max:255',

            'website_url'=>'required|max:255|url',

            'contact_person_name'=>'required|string|max:255',

            'contact_person_email'=>'required|email',

            'website_timezone'=>'required',

            'expired_subscription_file_delete_after'=>'required',

            'website_dark_logo'=>'sometimes|required|mimes:png,jpg,jpeg,svg | max:2048 | dimensions:max_width=112,max_height=15',

            'website_light_logo'=>'sometimes|mimes:png,jpg,jpeg,svg | max:2048',

            'website_fevicon_icon'=>'sometimes|mimes:png,jpg,jpeg,svg | max:2048',
        ];

    }

}