<?php

namespace App\Http\Requests\Backend\Setting;

use Illuminate\Foundation\Http\FormRequest;

class UploadsRequest extends FormRequest
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
            'storage_space'=>'required|integer|min:1|max:5120',
            'size_per_file'=>'required|integer|min:1|max:5120',
            'file_expired_in'=>'required|integer|min:1|max:365',
            'upload_at_once'=>'required|numeric|min:1|digits_between:1,5', 
        ];

    }

}