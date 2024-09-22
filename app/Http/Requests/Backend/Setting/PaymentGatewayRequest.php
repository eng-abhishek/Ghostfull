<?php

namespace App\Http\Requests\Backend\Setting;

use Illuminate\Foundation\Http\FormRequest;

class PaymentGatewayRequest extends FormRequest
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
            'name'=>'required|string|max:255',
            'logo'=>'image|mimes:png,jpg,jpeg|max:2048',
            'credentials'=>'required',
            'fees'=>'required|numeric',
            'min'=>'required|numeric',
             ];
    }

}