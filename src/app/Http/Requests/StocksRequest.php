<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;

class StocksRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'dateFrom' => [
                'required',
                'date_format:Y-m-d',
                function ($attribute, $value, $fail) {
                    if ($value !== Carbon::now()->format('Y-m-d')) {
                        $fail('Дата может быть только текущей: ' . Carbon::now()->format('Y-m-d'));
                    }
                }
            ],
            'limit' => ['nullable', 'integer', 'min:1', 'max:500'],
        ];
    }
}
