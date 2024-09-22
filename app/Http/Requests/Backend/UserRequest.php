<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
       // $this->username;

        if(!empty($this->user)){
            
            return [
                'firstname'=>'required|max:255',
                'lastname'=>'required|max:255',
                'username'=>'required|max:255|unique:users,username,'.$this->user,
                'phone_number'=>'required|numeric|digits_between:10,12|unique:users,phone_number,'.$this->user,
                'email' => 'required|email|max:255|unique:users,email,'.$this->user,
                'address'=>'required|max:255',
                'city'=>'required|max:255',
                'state'=>'required|max:255',
                'zipcode'=>'required|max:255',
                'country'=>'required|max:255',
                'password' => 'nullable|min:8|required_with:confirm_password|same:confirm_password',          
            ];

        }else{

         return [
            'firstname'=>'required|max:255',
            'lastname'=>'required|max:255',
            'username'=>'required|max:255|unique:users,username',
            'phone_number'=>'required|numeric|digits_between:10,12|unique:users,phone_number',
            'email' => 'required|email|max:255|unique:users,email',
            'address'=>'required|max:255',
            'city'=>'required|max:255',
            'state'=>'required|max:255',
            'zipcode'=>'required|max:255',
            'country'=>'required|max:255',
            'zipcode'=>'required|max:255',
            'password' => 'required|min:8|required_with:confirm_password|same:confirm_password', 
        ];

    }
}
}
