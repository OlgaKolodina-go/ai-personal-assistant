<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHabitRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // позже: auth
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string'],
            'description' => ['nullable', 'string'],

            'schedule' => ['required', 'array'],
            'schedule.time' => ['required', 'date_format:H:i'],
            'schedule.days_of_week' => ['required', 'array'],
            'schedule.days_of_week.*' => ['string'],
            'schedule.timezone' => ['required', 'string'],

            'reminder' => ['sometimes', 'array'],
            'reminder.enabled' => ['required_with:reminder', 'boolean'],
            'reminder.channel' => ['required_with:reminder', 'string'],
        ];
    }
}
