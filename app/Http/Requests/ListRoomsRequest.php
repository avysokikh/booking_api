<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ListRoomsRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'check_in_date' => 'nullable|date|after_or_equal:today',
            'check_out_date' => 'nullable|date|after:check_in_date',
        ];
    }

    public function messages(): array
    {
        return [
            'check_in_date.after_or_equal' => 'The check-in date must be today or a future date.',
            'check_out_date.after' => 'The check-out date must be after the check-in date.',
        ];
    }
}
