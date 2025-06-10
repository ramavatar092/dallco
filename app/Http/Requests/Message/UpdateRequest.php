<?php

namespace App\Http\Requests\Message;

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
            'date'        => 'required|date',
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'date.required'    => 'Message date is required.',
            'date.date_format' => 'Date must be in YYYY-MM-DD format.',
            'title.required'   => 'Title is required.',
        ];
    }
}
