<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
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
            'name'=>'required|string|min:3|max:20|unique:coupons,name,'.$this->coupon,
            'code'=>'required|max:100|unique:coupons,code,'.$this->coupon,
            'description'=>'required|string|max:255',
            'plan_id'=>'required',
            'discount_type'=>'required',
            'discount_amount'=>'required|integer|min:1',
            'limit_per_user'=>'required|integer|min:1',
            'start_date'=>'required',
            'end_date'=>'required',
        ];

    }

}