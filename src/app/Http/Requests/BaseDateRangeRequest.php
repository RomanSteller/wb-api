<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class BaseDateRangeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'dateFrom' => ['required', 'date_format:Y-m-d'],
            'dateTo' => ['required', 'date_format:Y-m-d', 'after_or_equal:dateFrom'],
            'limit' => ['nullable', 'integer', 'min:1', 'max:500'],
        ];
    }

    public function messages(): array
    {
        return [
            'dateFrom.required' => 'Поле dateFrom обязательно',
            'dateFrom.date_format' => 'Формат dateFrom должен быть Y-m-d',
            'dateTo.required' => 'Поле dateTo обязательно',
            'dateTo.date_format' => 'Формат dateTo должен быть Y-m-d',
            'dateTo.after_or_equal' => 'dateTo не может быть раньше dateFrom',
            'limit.max' => 'Максимум 500 записей за один запрос',
        ];
    }
}
