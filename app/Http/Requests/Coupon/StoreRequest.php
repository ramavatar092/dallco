<?php

namespace App\Http\Requests\Coupon;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'coupon_code'    => 'required|string|unique:coupons,coupon_code',
            'coupon_value'   => 'required|numeric|min:0',
            'coupon_date'    => 'required|date',
            'coupon_expiry'  => 'required|date|after_or_equal:coupon_date',
            'stauts_date'    => 'nullable|date',
            'remarks'        => 'nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'coupon_code.required'   => 'The coupon code is required.',
            'coupon_code.string'     => 'The coupon code must be a string.',
            'coupon_code.unique'     => 'This coupon code has already been used.',

            'coupon_value.required'  => 'The coupon value is required.',
            'coupon_value.numeric'   => 'The coupon value must be a number.',
            'coupon_value.min'       => 'The coupon value must be at least 0.',

            'coupon_date.required'   => 'The coupon start date is required.',
            'coupon_date.date'       => 'The coupon start date must be a valid date.',

            'coupon_expiry.required'     => 'The coupon expiry date is required.',
            'coupon_expiry.date'         => 'The coupon expiry date must be a valid date.',
            'coupon_expiry.after_or_equal' => 'The expiry date must be the same as or after the start date.',

            'coupon_status.required' => 'The coupon status is required.',
            'coupon_status.in'       => 'The selected status is invalid. Allowed: used, notused, cancelled.',

            'used_by.integer'        => 'Used by must be a valid user ID.',
            'used_by.exists'         => 'The selected user does not exist.',

            'stauts_date.date'       => 'The status date must be a valid date.',

            'remarks.string'         => 'Remarks must be a string.',
            'remarks.max'            => 'Remarks cannot exceed 255 characters.',
        ];
    }
}
