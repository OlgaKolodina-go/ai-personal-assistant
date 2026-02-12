<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHabitRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['sometimes', 'string', 'max:255'],
            'category' => ['sometimes', 'string'],
            'description' => ['nullable', 'string'],
            'active' => ['boolean'],

            'schedule.time' => ['sometimes', 'date_format:H:i'],
            'schedule.days_of_week' => ['sometimes', 'array'],
            'schedule.days_of_week.*' => ['string'],

            'reminder.enabled' => ['sometimes', 'boolean'],
            'reminder.channel' => ['sometimes', 'string'],
        ];
    }
}