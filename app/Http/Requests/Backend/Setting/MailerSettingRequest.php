<?php

namespace App\Http\Requests\Backend\Setting;

use Illuminate\Foundation\Http\FormRequest;

class MailerSettingRequest extends FormRequest
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
            'driver'=>'required|string|max:255',
            'port'=>'required|numeric',
            'host'=>'required|max:255',
            'from_name'=>'required|string|max:255',
            'encryption'=>'required|string|max:255',
            'from_email'=>'required|email|max:255',
            'password'=>'required',
             ];

    }

}