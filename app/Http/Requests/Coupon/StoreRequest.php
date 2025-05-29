<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCouponRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'coupon_code' => 'required|string|unique:coupons,coupon_code',
            'coupon_value' => 'required|numeric|min:0',
            'coupon_date' => 'required|date',
            'coupon_expiry' => 'required|date|after_or_equal:coupon_date',
            'coupon_status' => 'required|in:active,inactive,used',
            'used_by' => 'nullable|integer|exists:users,id',
            'stauts_date' => 'nullable|date',
            'remarks' => 'nullable|string|max:255',
        ];
    }
}
