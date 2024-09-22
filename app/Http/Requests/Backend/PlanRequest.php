<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class PlanRequest extends FormRequest
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
            'name'=>'required|string|max:255|unique:plans,name,'.$this->plan,
            'slug'=>'required|max:100|unique:plans,name,'.$this->plan,
            'short_description'=>'required|string|max:255',
            'interval'=>'required',
            'price'=>'sometimes|required|integer| min:1|digits_between:1,5',
            'storage_space'=>'sometimes|required|integer|min:1|max:10240',
            'size_per_file'=>'sometimes|required|integer|min:1|max:10240',
            'file_expired_in'=>'sometimes|required|integer|min:1|max:365',
            'upload_at_once'=>'required|numeric|min:1|digits_between:1,5',
            'other_features' => 'array|min:1',
            'other_features.*.key' => 'required|max:255',
            'other_features.*.value' => 'required|max:255',
        ];


    }


    public function messages()
    {
        return [
            'other_features.array' => 'Please fill other feature value',
            'other_features.*.key.required' => 'Please fill other feature status',
            'other_features.*.value.required' => 'Please fill other feature name',
        ];
    }

}