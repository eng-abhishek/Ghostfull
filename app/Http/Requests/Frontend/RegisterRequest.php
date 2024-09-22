<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'firstname'=>'required|max:255',
            'lastname'=>'required|max:255',
            'username'=>'required|max:255|unique:users,username',
            'phone_number'=>'required|numeric|digits_between:10,12|unique:users,phone_number',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:8',
            'password_confirmation'=>'required|min:8|same:password',
              ];
    }

    public function messages()
    {
        return [
         
        ];
    }

}
