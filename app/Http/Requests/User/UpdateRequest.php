<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'user_mobile'              => [
                                                'required',
                                                'regex:/^[6-9]\d{9}$/',
                                                Rule::unique('users', 'user_mobile')->ignore($this->route('user'))
                                        ],
            'name'                     => 'required|string|max:255',
            'city'                     => 'required|string|max:255',
            'address'                  => 'required|string|max:500',
            'state'                    => 'required|string|max:255',
            'register_date'            => 'required|date',
            'pincode'                  => 'required|digits:6',
            'bank_ifsc'                => 'nullable|string|max:20',
            'account_number'           => 'nullable|string|max:50',
            'upi_code'                 => 'nullable|string|max:100',
            //'mobile_notification_code' => 'nullable|string|max:10',
            'account_balance'          => 'required|numeric|min:0',
        ];
    }

    /**
     * Get custom error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'user_mobile.required'              => 'Mobile number is required.',
            'user_mobile.regex'                 => 'Please enter a valid 10-digit Indian mobile number.',
            'name.required'                     => 'Name is required.',
            'city.required'                     => 'City is required.',
            'address.required'                  => 'Address is required.',
            'state.required'                    => 'State is required.',
            'register_date.required'            => 'Register date is required.',
            'register_date.date'                => 'Register date must be a valid date.',
            'pincode.required'                  => 'Pincode is required.',
            'pincode.digits'                    => 'Pincode must be exactly 6 digits.',
            'bank_ifsc.required'                => 'Bank IFSC code is required.',
            'account_number.required'           => 'Account number is required.',
            'upi_code.required'                 => 'UPI code is required.',
            'mobile_notification_code.required' => 'Mobile notification code is required.',
            'account_balance.required'          => 'Account balance is required.',
            'account_balance.numeric'           => 'Account balance must be a numeric value.',
            'account_balance.min'               => 'Account balance must be at least 0.',
        ];
    }
}
