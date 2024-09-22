<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;
use \Illuminate\Validation\Rule as Rule;
use Illuminate\Http\Request;
class EditProfile extends FormRequest
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
            'username'=>['required','max:255',Rule::unique('users')->ignore($this->user()->id)],
            'phone_number'=>['required','numeric','digits_between:10,12',Rule::unique('users')->ignore($this->user()->id)],
            'email' => ['required','email','max:255',Rule::unique('users')->ignore($this->user()->id)],
            'address'=>'required|max:255',
            'city'=>'required|max:255',
            'state'=>'required|max:255',
            'zipcode'=>'required|max:255',
            'country'=>'required|max:255',
              ];
    }
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            //
        ];
    }
}
