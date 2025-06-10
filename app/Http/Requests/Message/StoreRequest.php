<?php

namespace App\Http\Requests\Message;

use Illuminate\Foundation\Http\FormRequest;


class StoreRequest extends FormRequest
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
            'date'        => 'required|date_format:Y-m-d',
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
        ];
    }

    /**
     * Custom error messages for validation.
     */
    public function messages(): array
    {
        return [
            'date.required'      => 'Message date is required.',
            'date.date_format'   => 'Date must be in YYYY-MM-DD format.',
            'title.required'     => 'Title is required.',
            'title.string'       => 'Title must be a string.',
            'title.max'          => 'Title may not be greater than 255 characters.',
            'description.string' => 'Description must be a string.',
        ];
    }
}