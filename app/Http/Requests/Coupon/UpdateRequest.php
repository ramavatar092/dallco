<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCouponRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'coupon_code' => 'sometimes|required|string|unique:coupons,coupon_code,' . $this->route('coupon'),
            'coupon_value' => 'sometimes|required|numeric|min:0',
            'coupon_date' => 'sometimes|required|date',
            'coupon_expiry' => 'sometimes|required|date|after_or_equal:coupon_date',
            'coupon_status' => 'sometimes|required|in:active,inactive,used',
            'used_by' => 'nullable|integer|exists:users,id',
            'stauts_date' => 'nullable|date',
            'remarks' => 'nullable|string|max:255',
        ];
    }
}
