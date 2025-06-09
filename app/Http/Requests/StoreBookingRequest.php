<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'room_id' => 'required|exists:rooms,id',
            'check_in_date' => 'required|date|after_or_equal:today',
            'check_out_date' => 'required|date|after:check_in_date',
        ];
    }

    public function messages(): array
    {
        return [
            'room_id.required' => 'Please select a room.',
            'room_id.exists' => 'The selected room does not exist.',
            'check_in_date.required' => 'Please select a check-in date.',
            'check_in_date.date' => 'The check-in date must be a valid date.',
            'check_in_date.after' => 'The check-in date must be today or a future date.',
            'check_out_date.required' => 'Please select a check-out date.',
            'check_out_date.date' => 'The check-out date must be a valid date.',
            'check_out_date.after' => 'The check-out date must be after the check-in date.',
        ];
    }
}
